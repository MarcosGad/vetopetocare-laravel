<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Selldogs;
use App\Refusal;
use App\User;
use DB;

class DogsController extends Controller
{
    public function index(){
        $dogs = Selldogs::select()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        $users = User::all();
        return view('admin.dogs.index', compact('dogs','users'));
    }

    public function create()
    {
        return view('admin.dogs.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'type' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'color' => ['required', 'string', 'max:255'],
            'strain' => ['required', 'string', 'max:255'],
            'n_strain' => ['required', 'string', 'max:255'],
            'pecial_marque' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:255'],
            'license' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'filename' =>  ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
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
    
             $Selldogs= new Selldogs();
             $Selldogs->type= $request->type;
             $Selldogs->purpose= $request->purpose;
             $Selldogs->address= $request->address;
             $Selldogs->description= $request->description;
             $Selldogs->color= $request->color;
             $Selldogs->strain= $request->strain;
             $Selldogs->n_strain= $request->n_strain;
             $Selldogs->pecial_marque= $request->pecial_marque;
             $Selldogs->price= $request->price;
             $Selldogs->currency= $request->currency;
             $Selldogs->license= $request->license;
             $Selldogs->sex= $request->sex;
             $Selldogs->active= 1;
             $Selldogs->user_id= 0;
             $Selldogs->filename=json_encode($data);
             $Selldogs->notes= $request->notes;
             $Selldogs->save();

            return redirect()->route('admin.dogs')->with(['success' => 'تم حفظ الحيوان بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.dogs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function createAccessories()
    {
        return view('admin.dogs.createAccessories');
    }

    public function storeAccessories(Request $request)
    {
        $this->validate($request,[
            'address' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'filename' =>  ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

            $Selldogs= new Selldogs();
            $Selldogs->purpose= 'مستلزمات';
            $Selldogs->address= $request->address;
            $Selldogs->price= $request->price;
            $Selldogs->active= 1;
            $Selldogs->user_id= 0;
            $Selldogs->filename=json_encode($data);
            $Selldogs->notes= $request->notes;
            $Selldogs->save();

            return redirect()->route('admin.dogs')->with(['success' => 'تم حفظ المستلزم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.dogs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Selldogs::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function insertRefusal(Request $request)
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
            
        $dog = Selldogs::find($request->with_id);
        if (!$dog) {
            return redirect()->route('admin.dogs', $id)->with(['error' => 'هذا الحيوان غير موجود']);
        }

        foreach(json_decode($dog->filename) as $file){
            $image = Str::after($file, 'assets/');
            $image = base_path('assets/' . $image);
            unlink($image);
        }
        $dog->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'تم الأرسال والحذف بنجاح'
            ]
        );
    }

    public function destroy($id){
        try {
            $dog = Selldogs::find($id);
            if (!$dog) {
                return redirect()->route('admin.dogs', $id)->with(['error' => 'هذا الحيوان غير موجود']);
            }

            foreach(json_decode($dog->filename) as $file){
                $image = Str::after($file, 'assets/');
                $image = base_path('assets/' . $image);
                unlink($image); //delete from folder
            }

            $dog->delete();
            return redirect()->route('admin.dogs')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.dogs')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $dog = Selldogs::find($id);
            if (!$dog)
                return redirect()->route('admin.dogs')->with(['error' => 'هذا الحيوان غير موجود ']);

           $status = $dog->active == 0 ? 1 : 0;

           $dog->update(['active' =>$status]);

           return redirect()->route('admin.dogs')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.dogs')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}