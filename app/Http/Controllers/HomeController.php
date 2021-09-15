<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\RequestsUser;
use App\Selldogs;
use App\Refusal;
use App\guide;
use App\User;
use Redirect;
use Auth;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function notActive()
    {
        return view('front.not-active');
    }

    public function add()
    {
        $dogs = Selldogs::all();
        return view('front.add',compact('dogs'));
    }

    public function profile()
    {
        $user = Auth::user();
        $country_list = DB::table('country_state_city')->where('active',1)->groupBy('country')
         ->get();
        return view('front.profile',compact('user','country_list'));
    }

    function profileFetch(Request $request)
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

   public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate($request, [ 
            "name"    => 'required|string|max:255',
            "birth"    => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:11'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
        ],[
            'required'  => 'هذا الحقل مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
            'email.unique' => 'البريد الإلكتروني موجود بالفعل',
        ]);
        
        try {
            $user = Auth::user();
            $user->name = $request->name;
            $user->birth = $request->birth;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->save();
           
            if ($request->has('password') && $request->password != null&& $request->new_password != null) {
            
                if (Hash::check($request->password , $user->password)) { 
                    
                   $user->fill([
                    'password' => bcrypt($request->new_password)
                    ])->save();
                
                } else {
                    return redirect()->back()->with('error', 'من فضلك تأكد من كلمة السر القديمة');      
                }
        
            }

            return back()->with('success', 'تم تحديث البيانات بنجاح');

        } catch (\Exception $ex) {
            return back()->with('error','حدث خطا ما برجاء المحاوله لاحقا');
        }
    }
    
    public function removeProfile(){
       $id = Auth::user()->id;
       $user = User::findOrFail($id);
       Auth::logout();
       if ($user->delete()) {
          return Redirect::route('home');
        }
    }


    //displayed
    public function displayed()
    {
        $waits = Selldogs::where('active',0)->where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $accepteds = Selldogs::where('active',1)->where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $refusals = Refusal::where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $guideWaits = guide::where('active',0)->where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $guideAccepteds = guide::where('active',1)->where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $RequestsUserWaits = RequestsUser::where('user_id',Auth::id())->get();
        return view('front.displayed',compact('waits','accepteds','refusals','guideWaits','guideAccepteds','RequestsUserWaits'));   
    }

    public function destroyDisplayed($id){
        try {
            $dog = Selldogs::find($id);
            if (!$dog) {
                return redirect()->route('home');
            }

            foreach(json_decode($dog->filename) as $file){
                $image = Str::after($file, 'assets/');
                $image = base_path('assets/' . $image);
                unlink($image);
            }

            $dog->delete();
            return redirect()->back();

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('home');
        }
    }

    public function destroyDisplayedRefusal($id){
        try {
            $refusal = Refusal::find($id);
            if (!$refusal) {
                return redirect()->route('home');
            }
            $refusal->delete();
            return redirect()->back();
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('home');
        }
    }

    public function destroyDisplayedGuide($id){
        try {
            $guide = guide::find($id);
            if (!$guide) {
                return redirect()->route('home');
            }

            foreach(json_decode($guide->filename) as $file){
                $image = Str::after($file, 'assets/');
                $image = base_path('assets/' . $image);
                unlink($image);
            }

            $guide->delete();
            return redirect()->back();

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('home');
        }
    }

    public function destroyDisplayedUserR($id)
    {
        try {
            $requestsUser = RequestsUser::find($id);
            if (!$requestsUser) {
                return redirect()->route('home');
            }
            $requestsUser->delete();
            return redirect()->back();
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('home');
        }
    }
    

    public function reqUser()
    {
        $userEmail = Auth::user()->email;
        return view('front.reqUser',compact('userEmail'));
    }

    public function sendReqUser(Request $request)
    {
        if ($request->type == 2) {

            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'address' => ['required', 'string', 'max:255'],
                'disclosure_price' => ['required', 'string', 'max:255'],
                'about_you' => ['required', 'string'],
                'license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image_of_the_guild_capricorn' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'Personal_identification_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => ['required', 'string', 'email', 'max:255'],
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
            ]);

        }
        elseif($request->type == 3){
            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'pharmacy_license' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => ['required', 'string', 'email', 'max:255'],
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'pharmacy_license.required' => 'رخصة الصيديلة مطلوبة',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
            ]);
        }
        else {
            $this->validate($request, [
                'type' =>  ['required', 'numeric'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
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

            $user = Auth::user();
            $user->address = $request->address;
            $user->disclosure_price = $request->disclosure_price;
            $user->about_you = $request->about_you;
            $user->license = $filePath;
            $user->pharmacy_license = $filePathThree;
            $user->image_of_the_guild_capricorn = $filePathOne;
            $user->Personal_identification_photo = $filePathTwo;
            $user->save();

            $RequestsUser = RequestsUser::create([
                'email' => $request->email,
                'user_id' => Auth::user()->id,
                'type' => $request->type,
                'address' => $request->address,
                'disclosure_price' => $request->disclosure_price,
                'about_you' => $request->about_you,
                'license' => $filePath,
                'pharmacy_license' => $filePathThree,
                'image_of_the_guild_capricorn' => $filePathOne,
                'Personal_identification_photo' => $filePathTwo,
            ]);
            return back()->with('success', 'تم ارسال طلبك بنجاح');
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('home');
        }
    }

    //Accessories
    public function accessories()
    {
        return view('front.accessories');
    }

}
