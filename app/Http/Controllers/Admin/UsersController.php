<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use DB;

class UsersController extends Controller
{
    public function index(){
        $users = User::select()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $country_list = DB::table('country_state_city')->where('active',1)->groupBy('country')
         ->get();
        return view('admin.users.create')->with('country_list', $country_list);
    }

    function fetch(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');
     $data = DB::table('country_state_city')
       ->where('active',1)
       ->where($select, $value)
       ->groupBy($dependent)
       ->get();
     $output = '<option value="">اختار</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
     }
     echo $output;
    }

    public function store(Request $request)
    {
         $time = strtotime($request->birth);
         $newformat = date('Y-m-d',$time);

        //  $unixTimestamp = strtotime($request->birth);
        //  $dayOfWeek = date("l", $unixTimestamp);
        //  dd( $request->birth . ' Day Is -  ' . $dayOfWeek);

        if ($request->type == 2) {

            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255'],
                'birth' => ['required', 'max:255'],
                'gender' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'disclosure_price' => ['required', 'string', 'max:255'],
                'about_you' => ['required', 'string'],
                'license' => 'required|mimes:jpg,jpeg,png',
                'image_of_the_guild_capricorn' => 'required|mimes:jpg,jpeg,png',
                'Personal_identification_photo' => 'required|mimes:jpg,jpeg,png',
                'phone' => ['required', 'string', 'max:11'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'address.required' => 'عنوان العيادة مطلوب',
                'disclosure_price.required' => 'سعر الكشف مطلوب',
                'about_you.required' => 'نبدة عنك مطلوب',
                'license.required' => 'صورة الرخصة مطلوبة',
                'image_of_the_guild_capricorn.required' => ' صورة كرنية النقابة مطلوبة',
                'Personal_identification_photo.required' => ' صورة كرنية النقابة مطلوبة',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
                'email.unique' => 'البريد الإلكتروني موجود بالفعل',
                'phone.max' => 'رقم المحمول لا يزيد عن 11 رقم',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان لا تقل عن 8 حروف'
            ]);

        }
        elseif($request->type == 3){
            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255'],
                'birth' => ['required', 'max:255'],
                'gender' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'pharmacy_license' => 'required|mimes:jpg,jpeg,png',
                'phone' => ['required', 'string', 'max:11'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'pharmacy_license.required' => 'رخصة الصيديلة مطلوبة',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
                'email.unique' => 'البريد الإلكتروني موجود بالفعل',
                'phone.max' => 'رقم المحمول لا يزيد عن 11 رقم',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان لا تقل عن 8 حروف'
            ]);
        }
        else {
            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255'],
                'birth' => ['max:255'],
                'gender' => ['max:255'],
                'country' => ['max:255'],
                'state' => ['max:255'],
                'city' => ['max:255'],
                'phone' => ['max:11'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
                'email.unique' => 'البريد الإلكتروني موجود بالفعل',
                'phone.max' => 'رقم المحمول لا يزيد عن 11 رقم',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان لا تقل عن 8 حروف'
            ]);
        }

        try {

            $filePath = "";
            if ($request->license) {
                $filePath = uploadImage('license', $request->license);
            }

            $filePathOne = "";
            if ($request->image_of_the_guild_capricorn) {
                $filePathOne = uploadImage('license', $request->image_of_the_guild_capricorn);
            }

            $filePathTwo = "";
            if ($request->Personal_identification_photo) {
                $filePathTwo = uploadImage('license', $request->Personal_identification_photo);
            }

            $filePathThree = "";
            if ($request->pharmacy_license) {
                $filePathThree = uploadImage('license', $request->pharmacy_license);
            }

            $user = User::create([
                'type' => $request->type,
                'name' => $request->name,
                'birth' => $newformat,
                'gender' => $request->gender,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'disclosure_price' => $request->disclosure_price,
                'about_you' => $request->about_you,
                'license' => $filePath,
                'image_of_the_guild_capricorn' => $filePathOne,
                'Personal_identification_photo' => $filePathTwo,
                'pharmacy_license' => $filePathThree,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->type == 1) {
                $user->fill(['active' => 1])->save();
                return redirect()->route('admin.users')->with(['success' => 'تم حفظ المستخدم بنجاح']);
            };

            return redirect()->route('admin.users')->with(['success' => 'تم حفظ المستخدم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function edit($id)
    {
        $user = User::select()->find($id);
        if (!$user) {
            return redirect()->route('admin.users')->with(['error' => 'هذا المستخدم غير موجود']);
        }

        $country_list = DB::table('country_state_city')
         ->get();

        return view('admin.users.edit', compact('user','country_list'));
    }


    public function update($id, Request $request)
    {
        if ($request->type == 2) {
            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255'],
                'birth' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'disclosure_price' => ['required', 'string', 'max:255'],
                'about_you' => ['required', 'string'],
                'license' => 'required_without:id|mimes:jpg,jpeg,png',
                'image_of_the_guild_capricorn' => 'required_without:id|mimes:jpg,jpeg,png',
                'Personal_identification_photo' => 'required_without:id|mimes:jpg,jpeg,png',
                'phone' => ['required', 'string', 'max:11'],
                'email' => 'required|unique:users,email,'.$id,
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'address.required' => 'عنوان العيادة مطلوب',
                'disclosure_price.required' => 'سعر الكشف مطلوب',
                'about_you.required' => 'نبدة عنك مطلوب',
                'license.required' => 'صورة الرخصة مطلوبة',
                'image_of_the_guild_capricorn.required' => ' صورة كرنية النقابة مطلوبة',
                'Personal_identification_photo.required' => ' صورة كرنية النقابة مطلوبة',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
                'email.unique' => 'البريد الإلكتروني موجود بالفعل',
                'phone.max' => 'رقم المحمول لا يزيد عن 11 رقم',
            ]);
        }
        elseif($request->type == 3){
            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255'],
                'birth' => ['required', 'max:255'],
                'gender' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'pharmacy_license' => 'required_without:id|mimes:jpg,jpeg,png',
                'phone' => ['required', 'string', 'max:11'],
                'email' => 'required|unique:users,email,'.$id,
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'pharmacy_license.required' => 'رخصة الصيديلة مطلوبة',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
                'email.unique' => 'البريد الإلكتروني موجود بالفعل',
                'phone.max' => 'رقم المحمول لا يزيد عن 11 رقم',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان لا تقل عن 8 حروف'
            ]);
        }
        else {
            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255'],
                'birth' => ['max:255'],
                'gender' => ['max:255'],
                'country' => ['max:255'],
                'state' => ['max:255'], 
                'city' => ['max:255'],
                'phone' => ['max:11'],
                'email' => 'required|unique:users,email,'.$id,
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
                'email.unique' => 'البريد الإلكتروني موجود بالفعل',
                'phone.max' => 'رقم المحمول لا يزيد عن 11 رقم',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان لا تقل عن 8 حروف'
            ]);
        }

        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('admin.users.edit', $id)->with(['error' => 'هذا المستخدم غير موجود']);
            }

            if($user->type == 1 && $request->type == 2 && $request->license == null){
                return redirect()->route('admin.users')->with(['error' => 'يجب رفع صورة الرخصة لتحوبل المستخدم من عادى الى عيادة']);
            }

            if ($request->has('license')) {
                $filePath = uploadImage('license', $request->license);
                User::where('id', $id)
                    ->update([
                            'license' => $filePath,
                ]);
            }

            if ($request->has('image_of_the_guild_capricorn')) {
                $filePathOne = uploadImage('license', $request->image_of_the_guild_capricorn);
                User::where('id', $id)
                    ->update([
                            'image_of_the_guild_capricorn' => $filePathOne,
                ]);
            }

            if ($request->has('Personal_identification_photo')) {
                $filePathTwo = uploadImage('license', $request->Personal_identification_photo);
                User::where('id', $id)
                    ->update([
                            'Personal_identification_photo' => $filePathTwo,
                ]);
            }

            if ($request->has('pharmacy_license')) {
                $filePathThree = uploadImage('license', $request->pharmacy_license);
                User::where('id', $id)
                    ->update([
                            'pharmacy_license' => $filePathThree,
                ]);
            }

            $user->update([
                'type' => $request->type,
                'name' => $request->name,
                'birth' => $request->birth,
                'gender' => $request->gender,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'disclosure_price' => $request->disclosure_price,
                'about_you' => $request->about_you,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            if ($request->has('password') && $request->password != null) {
                $user->fill(['password' => Hash::make($request->password)])->save();   
            }
            return redirect()->route('admin.users')->with(['success' => 'تم تحديث المستخدم بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id){

        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('admin.users', $id)->with(['error' => 'هذا المستخدم غير موجود']);
            }

            if($user->type == 2){
                $image = Str::after($user->license, 'assets/');
                $image = base_path('assets/' . $image);
                unlink($image); 

                $imageOne = Str::after($user->image_of_the_guild_capricorn, 'assets/');
                $imageOne = base_path('assets/' . $imageOne);
                unlink($imageOne); 

                $imageTwo = Str::after($user->Personal_identification_photo, 'assets/');
                $imageTwo = base_path('assets/' . $imageTwo);
                unlink($imageTwo); 
            }

            if($user->type == 3){
                $image = Str::after($user->pharmacy_license, 'assets/');
                $image = base_path('assets/' . $image);
                unlink($image);
            }

            $user->delete();
            return redirect()->route('admin.users')->with(['success' => 'تم حذف المستخدم بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.users')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $user = User::find($id);
            if (!$user)
                return redirect()->route('admin.users')->with(['error' => 'هذا المستخدم غير موجود ']);

           $status = $user->active == 0 ? 1 : 0;

           $user->update(['active' =>$status]);

           return redirect()->route('admin.users')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.users')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}