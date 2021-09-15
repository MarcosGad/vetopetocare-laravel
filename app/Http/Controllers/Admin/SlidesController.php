<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Slide;
use DB;

class SlidesController extends Controller
{
    public function index(){
        $slides = Slide::select()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'headr' => ['required', 'string', 'max:255'],
            'paragraph' => ['required', 'string', 'max:255'],
            'button_name' => ['max:255'],
            'button_url' => ['max:255'],
            'filename' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ],[
            'required'  => 'هذا الحقل مطلوب',
            'string'  => 'هذا الحقل يجب ان يكون به نص',
            'filename.mimes'  => 'يجب ان تكون الصورة من نوع jpeg,png,jpg,gif,svg وحجمها 2048',
            'filename.image'  => 'برجاء ادخل صورة',
        ]);

        try {

            $filePath = "";
            if ($request->filename) {
                $filePath = uploadImage('license', $request->filename);
            }
    
             $Slides= new Slide();
             $Slides->headr= $request->headr;
             $Slides->paragraph= $request->paragraph;
             $Slides->button_name= $request->button_name;
             $Slides->button_url= $request->button_url;
             $Slides->filename= $filePath;
             $Slides->active= 1;
             $Slides->user_id= 0;
             $Slides->save();

            return redirect()->route('admin.slides')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.slides')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function edit($id)
    {
        $slide = Slide::select()->find($id);
        if (!$slide) {
            return redirect()->route('admin.slides')->with(['error' => 'غير موجود']);
        }
        return view('admin.slides.edit', compact('slide'));
    }


    public function update($id, Request $request)
    {
        $this->validate($request,[

            'headr' => ['required', 'string', 'max:255'],
            'paragraph' => ['required', 'string', 'max:255'],
            'button_name' => ['max:255'],
            'button_url' => ['max:255'],
            'filename' => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'required'  => 'هذا الحقل مطلوب',
            'filename.mimes'  => 'يجب ان تكون الصورة من نوع jpeg,png,jpg,gif,svg وحجمها 2048',
            'filename.image'  => 'برجاء ادخل صورة',
        ]);

        try {
 
            $slide = Slide::select()->find($id);
            if (!$slide)
                return redirect()->route('admin.slides')->with(['error' => ' غير موجود ']);
            DB::beginTransaction();

            if ($request->has('filename') ) {
                $filePath = uploadImage('license', $request->filename);
                Slide::where('id', $id)
                    ->update([
                        'filename' => $filePath,
                    ]);
            }

            $data = $request->except('_token', 'id', 'filename');
            Slide::where('id', $id)
                ->update(
                    $data
                );

            DB::commit();
            return redirect()->route('admin.slides')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.slides')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id){

        try {
            $slide = Slide::find($id);
            if (!$slide) {
                return redirect()->route('admin.slides', $id)->with(['error' => 'غير موجود']);
            }

            $image = Str::after($slide->filename, 'assets/');
            $image = base_path('assets/' . $image);
            unlink($image); //delete from folder

            $slide->delete();
           
            return redirect()->route('admin.slides')->with(['success' => 'تم حذف بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.slides')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $slide = Slide::find($id);
            if (!$slide)
                return redirect()->route('admin.slides')->with(['error' => ' غير موجود']);

           $status = $slide->active == 0 ? 1 : 0;

           $slide->update(['active' =>$status]);

           return redirect()->route('admin.slides')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.slides')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    
}