<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;


class RegisterController extends BaseController
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'birth' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $createUser = User::create([
            'type' => 1,
            'name' => $request->name,
            'birth' => $request->birth,
            'gender' => $request->gender,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => 1,
        ]);
        
        $success['token'] = $createUser->createToken('MyApp')->accessToken;
        $success['user'] = $createUser;
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] = $user->createToken('MyApp')-> accessToken; 
            $success['user'] = Auth::user();
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
    
    
    public function handleFacebookLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'facebook_id' => ['required', 'string', 'max:255'],
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $finduser = User::where('facebook_id', $request->facebook_id)->first();
        if ($finduser) {
            $success['token'] = $finduser->createToken('MyApp')-> accessToken; 
            $success['user'] = $finduser;
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            $newUser = User::create(['type' => 1,'name' => $request->name, 'email' => $request->email, 'facebook_id' => $request->facebook_id, 'active' => 1]);
            $success['token'] = $newUser->createToken('MyApp')-> accessToken; 
            $success['user'] = $newUser;
            return $this->sendResponse($success, 'User login successfully.');
        };
    }
    
    public function handleGoogleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'google_id' => ['required', 'string', 'max:255'],
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $finduser = User::where('google_id', $request->google_id)->first();
        if ($finduser) {
            $success['token'] = $finduser->createToken('MyApp')-> accessToken; 
            $success['user'] = $finduser;
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            $newUser = User::create(['type' => 1,'name' => $request->name, 'email' => $request->email, 'google_id' => $request->google_id, 'active' => 1]);
            $success['token'] = $newUser->createToken('MyApp')-> accessToken; 
            $success['user'] = $newUser;
            return $this->sendResponse($success, 'User login successfully.');
        };
    }
    
    
    public function detailsUser(Request $request)
    {
        $user = Auth::user(); 
        $success['user'] = $user;
        return $this->sendResponse($success, 'User Details.');
    }
    
    
    //editUser
    public function editUser(Request $request, user $user)
    {
        $user = Auth::user();
        Validator::make($request->all(), [
            "name"  => 'required|string|max:255',
            "birth"  => 'required|string|max:255',
            "phone"  => 'required|string|max:11',
            "gender"  => 'required|string|max:255',
            "email"  => 'required|string|email|max:255',
            "password"  => 'min:6',
            "new_password" => 'min:6',
        ]);
       
        $user->name = $request->name;
        $user->birth = $request->birth;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->save();
        
        if ($request->has('password') && $request->password != null
        && $request->new_password != null) {
            if (Hash::check($request->password , $user->password)) { 
               $user->fill([
                'password' => bcrypt($request->new_password)
                ])->save();
            
            } else {
                $mas = 'تأكد من كلمة السر القديمة'; 
                return response()->json($mas);
            }
        }
        //return response()->json($user);
        $mas = 'تم تعديل البيانات بنجاح'; 
        return response()->json($mas);
    }
    
    
    public function ResetPasswordApi(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        $token = Password::getRepository()->create($user);
        $user->sendPasswordResetNotification($token);    
        $success['mass'] = ''; 
        return $this->sendResponse($success, 'We have e-mailed your password reset link!');
    }
    
    public function removeProfile(){
       $id = Auth::user()->id;
       $user = User::findOrFail($id);
       Auth::user()->tokens->each(function($token, $key) {
           $token->delete();
       });
       if ($user->delete()) {
           $mas = 'تم حذف الحساب بنجاح';
           return response()->json($mas);
       }
    }
}