<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Country_state_city;

class AreasController extends Controller
{
    public function index(){
        $country_state_cities = Country_state_city::select()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.areas.index', compact('country_state_cities'));
    }

    public function create()
    {
        return view('admin.areas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ],[
            'required'  => 'هذا الحقل مطلوب',
        ]);

        try {
             $country_state_city= new Country_state_city();
             $country_state_city->country= $request->country;
             $country_state_city->state= $request->state;
             $country_state_city->city= $request->city;
             $country_state_city->active= 1;
             $country_state_city->user_id= 0;
             $country_state_city->save();
            return redirect()->route('admin.areas')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.areas')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function edit($id)
    {
        $country_state_city = Country_state_city::select()->find($id);
        if (!$country_state_city) {
            return redirect()->route('admin.areas')->with(['error' => 'غير موجود']);
        }
        return view('admin.areas.edit', compact('country_state_city'));
    }


    public function update($id, Request $request)
    {
        $this->validate($request,[
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ],[
            'required'  => 'هذا الحقل مطلوب',
        ]);

        try {
 
            $country_state_city = Country_state_city::select()->find($id);
            if (!$country_state_city)
                return redirect()->route('admin.areas')->with(['error' => ' غير موجود ']);
  

            $data = $request->except('_token', 'id');
            Country_state_city::where('id', $id)
                ->update(
                    $data
                );

            return redirect()->route('admin.areas')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.areas')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id){

        try {
            $country_state_city = Country_state_city::find($id);
            if (!$country_state_city) {
                return redirect()->route('admin.areas', $id)->with(['error' => 'غير موجود']);
            }

            $country_state_city->delete();
           
            return redirect()->route('admin.areas')->with(['success' => 'تم حذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.areas')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $country_state_city = Country_state_city::find($id);
            if (!$country_state_city)
                return redirect()->route('admin.areas')->with(['error' => ' غير موجود']);

           $status = $country_state_city->active == 0 ? 1 : 0;

           $country_state_city->update(['active' =>$status]);

           return redirect()->route('admin.areas')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.areas')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    
}