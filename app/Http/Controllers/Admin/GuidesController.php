<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\BusinessHours;
use App\guide;
use App\Refusal;
use App\User;
use DB;

class GuidesController extends Controller
{
    public function index(){
        $guides = guide::select()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        $users = User::all();
        return view('admin.guides.index', compact('guides','users'));
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = guide::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function create()
    {
        return view('admin.guides.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'filename' =>  ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            'landline_phone' => ['required', 'string', 'max:11'],
            'offers_services' => ['required', 'string'],
        ],[
            'required'  => 'هذا الحقل مطلوب',
        ]);

        try {
         
            if($request->hasfile('filename'))
            {
                foreach($request->file('filename') as $image)
                {
                    $filePath = uploadImage('license', $image);
                    $data[] = $filePath;  
                }
            }

         $guide= new guide();
         $guide->name= $request->name;
         $guide->filename=json_encode($data);
         $guide->address= $request->address;
         $guide->phone= $request->phone;
         
         $guide->landline_phone= $request->landline_phone;
         $guide->yes_or_no= $request->yes_or_no;
         $guide->yes_or_no_two= $request->yes_or_no_two;
         $guide->home_detection_rate= $request->home_detection_rate;
         $guide->regular_check_up_price= $request->regular_check_up_price;
         $guide->doctor_name= $request->doctor_name;
         $guide->price_of_the_delivery_service= $request->price_of_the_delivery_service;

         $guide->offers_services= $request->offers_services;
         $guide->type= $request->type;
         $guide->user_id= 0;
         $guide->active= 1;
         $guide->save();

         if($request->has('weekDay') && $request->has('start_time') && $request->has('end_time')){
            foreach( $request->weekDay as $key => $n ) {
                if($request->start_time[$key] && $request->end_time[$key] != 'off'){
                   BusinessHours::create(['weekDay' => $n, 'start_time' => $request->start_time[$key], 'end_time' => $request->end_time[$key], 'item_id' => $guide->id, 'user_id' => Auth::id()]); 
                }            }
            return redirect()->route('admin.guides')->with(['success' => 'تم حفظ الدليل بنجاح']);
         }
            return redirect()->route('admin.guides')->with(['success' => 'تم حفظ الدليل بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.guides')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function insertRefusalTwo(Request $request)
    {
            $this->validate($request, [
                'with_id' =>  ['required', 'numeric'],
                'user_id' =>  ['required', 'numeric'],
                'one' => ['required', 'string', 'max:255'],
                'two' => ['required', 'string', 'max:255'],
                'details' => ['required', 'string', 'max:255'],
            ],[
                'required'  => 'هذا الحقل مطلوب',
            ]);
            
            Refusal::create($request->all());
                
            $guide = guide::find($request->with_id);
            if (!$guide) {
                return redirect()->route('admin.guides', $id)->with(['error' => 'هذا الحيوان غير موجود']);
            }
    
            foreach(json_decode($guide->filename) as $file){
                $image = Str::after($file, 'assets/');
                $image = base_path('assets/' . $image);
                unlink($image);
            }
            $guide->delete();
    
            return response()->json(
                [
                    'success' => true,
                    'message' => 'تم الأرسال والحذف بنجاح'
                ]
            );
    }

    public function destroy($id){
        try {
            $guide = guide::find($id);
            if (!$guide) {
                return redirect()->route('admin.guides', $id)->with(['error' => 'هذا الدليل غير موجود']);
            }

            foreach(json_decode($guide->filename) as $file){
                $image = Str::after($file, 'assets/');
                $image = base_path('assets/' . $image);
                unlink($image); 
            }

            $guide->delete();
            return redirect()->route('admin.guides')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.guides')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $guide = guide::find($id);
            if (!$guide)
                return redirect()->route('admin.guides')->with(['error' => 'هذا الدليل غير موجود ']);

           $status = $guide->active == 0 ? 1 : 0;

           $guide->update(['active' =>$status]);

           return redirect()->route('admin.guides')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.guides')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}