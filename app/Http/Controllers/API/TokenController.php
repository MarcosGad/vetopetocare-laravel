<?php
   
namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationUser;
use Illuminate\Support\Str;
use App\Mail\Clinic;
use App\SendSmsPhone;
use App\RequestsUser;
use App\Selldogs;
use App\wishlist;
use App\Refusal;
use Validator;
use App\guide;
use App\User;
use DB;

   
class TokenController extends BaseController
{
    public function ratingDog(Request $request)
    {
        request()->validate(['rate' => 'required']);
        $dog = Selldogs::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $dog->ratings()->save($rating);
        
        $averageRating = $dog->averageRating;
        $usersRated = $dog->usersRated();
        $success['averageRating'] = $averageRating;
        $success['usersRated'] = $usersRated;
        return $this->sendResponse($success, 'Rating Done.');
    }
    
    public function wishlist(Request $request)
    {
        request()->validate(['id' => 'required']);
        $wishlist = wishlist::create(['item_id' => $request->id, 'user_id' => Auth::id(), 'item_type' => 'dogs']);
        $success['mass'] = 'تم الاضافة الى القائمة المفضلة';
        return $this->sendResponse($success, 'Wishlist Done.');
    }
    
    public function getWishlist()
    {
        $wishlistItem = DB::table('wishlists')->select('item_id')->where('item_type','dogs')->where('user_id',Auth::id())->get();
        $wishlistItemId = array();
        foreach ($wishlistItem as $i) {
            array_push($wishlistItemId,$i->item_id);
        };        
        $dogs = Selldogs::where('active',1)->whereIn('id', $wishlistItemId)->get();
        $success['dogs'] = $dogs;
        return $this->sendResponse($success, 'Wishlist Get Done.');
    }
    
    public function destroyWishlist($id){
        $wishlist = DB::table('wishlists')->where('item_id', $id)->where('user_id', Auth::id())->where('item_type', 'dogs')->delete();
        $success['mass'] = 'تم الحذف من القائمة المفضلة';
        return $this->sendResponse($success, 'Wishlist Done.');
    }
    
    public function ratingGuide(Request $request)
    {
        request()->validate(['rate' => 'required']);
        $guide = guide::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $guide->ratings()->save($rating);
       
        $averageRating = $guide->averageRating;
        $usersRated = $guide->usersRated();
        $success['averageRating'] = $averageRating;
        $success['usersRated'] = $usersRated;
        return $this->sendResponse($success, 'Rating Done.');
    }
    
    //send ReservationUser
    public function ReservationUser(Request $request)
    {
        $data = request()->validate([
            'id' => 'required',
            'phone' => 'required',
            'mass' => 'required',
        ]);        

        $clinicEmail = User::select('email')->find($data['id']);
        $userEmail = auth()->user()->email;
        $userName = auth()->user()->name;
        $userPhone = auth()->user()->phone;

        Mail::to($userEmail)->send(new ReservationUser($data));
        Mail::to($clinicEmail->email)->send(new Clinic($data,$userName,$userPhone));

        SendSmsPhone::create(['item_id' => $request->item_id, 'user_id' => Auth::id(), 'mass' => $request->mass ,'item_type' => 'clinic']);
        $success['mass'] = 'تم الحجز بنجاح';
        return $this->sendResponse($success, 'ReservationUser Done.');
    }
    
    
    public function addDog(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
             //'filename' =>  ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        // if($request->hasfile('filename'))
        // {
        //     foreach($request->file('filename') as $image)
        //     {
        //         $filePath = uploadImage('license', $image);
        //         $data[] = $filePath;  
        //     }
        // }

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
         $Selldogs->user_id= Auth::id();
         //$Selldogs->filename=json_encode($data);
         $Selldogs->notes= $request->notes;
         $Selldogs->save();
    
        $success['dog'] = $Selldogs;
        return $this->sendResponse($success, 'Dog add successfully.');
    }
    
    public function addAccessories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            //'filename' =>  ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        // if($request->hasfile('filename'))
        // {
        //     foreach($request->file('filename') as $image)
        //     {
        //         $filePath = uploadImage('license', $image);
        //         $data[] = $filePath;  
        //     }
        // }

        $Selldogs= new Selldogs();
        $Selldogs->purpose= 'مستلزمات';
        $Selldogs->address= $request->address;
        $Selldogs->price= $request->price;
        $Selldogs->user_id= Auth::id();
        //$Selldogs->filename=json_encode($data);
        $Selldogs->notes= $request->notes;
        $Selldogs->save();
    
        $success['dog'] = $Selldogs;
        return $this->sendResponse($success, 'Accessories add successfully.');
    }
    
    
    public function displayed()
    {
        $waits = Selldogs::where('active',0)->where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $accepteds = Selldogs::where('active',1)->where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $refusals = Refusal::where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $guideWaits = guide::where('active',0)->where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $guideAccepteds = guide::where('active',1)->where('user_id',Auth::id())->orderBy('id', 'desc')->get();
        $RequestsUserWaits = RequestsUser::where('user_id',Auth::id())->get();
        
        $success['waits'] = $waits;
        $success['accepteds'] = $accepteds;
        $success['refusals'] = $refusals;
        $success['guideWaits'] = $guideWaits;
        $success['guideAccepteds'] = $guideAccepteds;
        $success['RequestsUserWaits'] = $RequestsUserWaits;
        return $this->sendResponse($success, 'Displayed Get successfully.');
    }
    
    public function destroyDisplayed($id){
        $dog = Selldogs::find($id);
        foreach(json_decode($dog->filename) as $file){
            $image = Str::after($file, 'assets/');
            $image = base_path('assets/' . $image);
            unlink($image);
        }
        $dog->delete();
        $success['mass'] = 'تم الحذف بنجاح';
        return $this->sendResponse($success, 'Done.');
    }
    
    public function destroyDisplayedRefusal($id){
        $refusal = Refusal::find($id);
        $refusal->delete();
        $success['mass'] = 'تم الحذف بنجاح';
        return $this->sendResponse($success, 'Done.');
    }
    
    public function destroyDisplayedGuide($id){
        $guide = guide::find($id);
        foreach(json_decode($guide->filename) as $file){
                $image = Str::after($file, 'assets/');
                $image = base_path('assets/' . $image);
                unlink($image);
        }
        $guide->delete();
        $success['mass'] = 'تم الحذف بنجاح';
        return $this->sendResponse($success, 'Done.');
    }
    
    public function destroyDisplayedUserR($id)
    {
        $requestsUser = RequestsUser::find($id);
        $requestsUser->delete();
        $success['mass'] = 'تم الحذف بنجاح';
        return $this->sendResponse($success, 'Done.');
    }
    
    public function sendReqUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' =>  ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
            'disclosure_price' => ['required', 'string', 'max:255'],
            'about_you' => ['required', 'string'],
            //'license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'image_of_the_guild_capricorn' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'Personal_identification_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'pharmacy_license' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        // $filePath = "";
        // if ($request->license) {
        //     $filePath = uploadImage('license', $request->license);
        // }

        // $filePathOne = "";
        // if ($request->image_of_the_guild_capricorn) {
        //     $filePathOne = uploadImage('license', $request->image_of_the_guild_capricorn);
        // }

        // $filePathTwo = "";
        // if ($request->Personal_identification_photo) {
        //     $filePathTwo = uploadImage('license', $request->Personal_identification_photo);
        // }

        // $filePathThree = "";
        // if ($request->pharmacy_license) {
        //     $filePathThree = uploadImage('license', $request->pharmacy_license);
        // }

        $user = Auth::user();
        $user->address = $request->address;
        $user->disclosure_price = $request->disclosure_price;
        $user->about_you = $request->about_you;
        //$user->license = $filePath;
        //$user->pharmacy_license = $filePathThree;
        //$user->image_of_the_guild_capricorn = $filePathOne;
        //$user->Personal_identification_photo = $filePathTwo;
        $user->save();

        $RequestsUser = RequestsUser::create([
            'email' => $request->email,
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            'address' => $request->address,
            'disclosure_price' => $request->disclosure_price,
            'about_you' => $request->about_you,
            //'license' => $filePath,
            //'pharmacy_license' => $filePathThree,
            //'image_of_the_guild_capricorn' => $filePathOne,
            //'Personal_identification_photo' => $filePathTwo,
        ]);
        
        $success['mass'] = 'تم ارسال الطلب بنجاح';
        return $this->sendResponse($success, 'Done.');
    }
    
}