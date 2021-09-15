<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Testimonial;

class TestimonialsController extends Controller
{
    public function index(){
        $testimonials = Testimonial::select()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'paragraph' => ['required', 'string'],           
        ],[
            'required'  => 'هذا الحقل مطلوب',
            'string'  => 'هذا الحقل يجب ان يكون به نص',
        ]);

        try {
             $Testimonial= new Testimonial();
             $Testimonial->paragraph= $request->paragraph;
             $Testimonial->active= 1;
             $Testimonial->user_id= 0;
             $Testimonial->save();
            return redirect()->route('admin.testimonials')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.testimonials')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function edit($id)
    {
        $testimonial = Testimonial::select()->find($id);
        if (!$testimonial) {
            return redirect()->route('admin.testimonials')->with(['error' => 'غير موجود']);
        }
        return view('admin.testimonials.edit', compact('testimonial'));
    }


    public function update($id, Request $request)
    {
        $this->validate($request,[
            'paragraph' => ['required', 'string'],
        ],[
            'required'  => 'هذا الحقل مطلوب',
            'string'  => 'هذا الحقل يجب ان يكون به نص',
        ]);

        try { 
            $testimonial = Testimonial::select()->find($id);
            if (!$testimonial)
                return redirect()->route('admin.testimonials')->with(['error' => ' غير موجود ']);

            $data = $request->except('_token', 'id');
            Testimonial::where('id', $id)
                ->update(
                    $data
                );

            return redirect()->route('admin.testimonials')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.testimonials')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id){
        try {
            $testimonial = Testimonial::find($id);
            if (!$testimonial) {
                return redirect()->route('admin.testimonials', $id)->with(['error' => 'غير موجود']);
            }
            $testimonial->delete();
            return redirect()->route('admin.testimonials')->with(['success' => 'تم حذف بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.testimonials')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $testimonial = Testimonial::find($id);
            if (!$testimonial)
                return redirect()->route('admin.testimonials')->with(['error' => ' غير موجود']);

           $status = $testimonial->active == 0 ? 1 : 0;

           $testimonial->update(['active' =>$status]);

           return redirect()->route('admin.testimonials')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.testimonials')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
   
}