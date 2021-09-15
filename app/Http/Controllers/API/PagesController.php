<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\BusinessHours;
use App\Testimonial;
use App\Selldogs;
use App\viewers;
use App\Slide;
use App\guide;
use App\User;
use DB;



class PagesController extends BaseController
{
  
    public function slide()
    {
        $slides = Slide::where('active',1)->orderBy('id', 'desc')->get();
        $success['slide'] = $slides;
        return $this->sendResponse($success, 'get data is successfully.');
    }
  
    public function testimonial()
    {
        $testimonials = Testimonial::where('active',1)->orderBy('id', 'desc')->get();
        $success['testimonial'] = $testimonials;
        return $this->sendResponse($success, 'get data is successfully.');
    }
    
    public function randomDogs()
    {
        $dogs = Selldogs::where('active',1)->inRandomOrder()->limit(8)->get();
        $success['dogs'] = $dogs;
        return $this->sendResponse($success, 'get data is successfully.');
    }
    
    public function allDogs()
    {
        $dogs = Selldogs::where('active',1)->orderBy('id', 'desc')->get();;
        $success['dogs'] = $dogs;
        return $this->sendResponse($success, 'get data is successfully.');
    }
    
    public function filterDogs($type)
    {
        $dogs = Selldogs::where('active',1)->where('purpose',$type)->orderBy('id', 'desc')->get();
        $success['dogs'] = $dogs;
        return $this->sendResponse($success, 'get data is successfully.');
    }
    
    public function searchSDogs(Request $request)
    {
        $dogs = Selldogs::where('strain', 'LIKE', $request->strain.'%')
                ->get();
        $success['dogs'] = $dogs;
        return $this->sendResponse($success, 'get data is successfully.');
    }
    
    public function allService()
    {
        $services = guide::where('active',1)->orderBy('id', 'desc')->get();
        $success['services'] = $services;
        return $this->sendResponse($success, 'get data is successfully.');
    }
    
    public function service($type)
    {
        $services = guide::where('active',1)->where('type',$type)->orderBy('id', 'desc')->get();
        $success['services'] = $services;
        return $this->sendResponse($success, 'get data is successfully.');
    }
    
    public function contactus()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('info@vetopetocare.com')->send(new ContactFormMail($data));
        $success['mass'] = '';
        return $this->sendResponse($success, 'Message Done.');
    }
    
    public function showDog($id,$userId)
    {
        
        $singledog = Selldogs::select()->find($id);
    
        $previous = Selldogs::where('active',1)->where('id', '<', $singledog->id)->max('id');
        $previousName = Selldogs::where('active',1)->select('purpose','strain','address')->find($previous);
        $next = Selldogs::where('active',1)->where('id', '>', $singledog->id)->min('id');
        $nextName = Selldogs::where('active',1)->select('purpose','strain','address')->find($next);
        $dogs = Selldogs::where('active',1)->inRandomOrder()->limit(3)->get();

        $ratingUsers = DB::table('ratings')->select('user_id')->where('rateable_type','App\Selldogs')->where('rateable_id',$id)->get();
        $ratingUsersId = array();
        foreach ($ratingUsers as $s) {
            array_push($ratingUsersId,$s->user_id);
        };
        $ratingForm;
        if (in_array($userId,$ratingUsersId)){ $ratingForm = true; }
        else{ $ratingForm = false; }

        $wishlistUsers = DB::table('wishlists')->select('user_id')->where('item_type','dogs')->where('item_id',$id)->get();
        $wishlistUsersId = array();
        foreach ($wishlistUsers as $s) {
            array_push($wishlistUsersId,$s->user_id);
        };
        $wishlistForm;
        if (in_array($userId,$wishlistUsersId)){ $wishlistForm = true; }
        else{ $wishlistForm = false; }

        if($userId !== null){
            $viewersUsers = DB::table('viewers')->select('user_id')->where('item_type','dogs')->where('item_id',$id)->get();
            $viewersUsersId = array();
            foreach ($viewersUsers as $v) {
                array_push($viewersUsersId,$v->user_id);
            };
            $addViewe;
            if (in_array($userId,$viewersUsersId)){ $addViewe = true; }
            else{ $addViewe = false; }
            if(!$addViewe){
                Selldogs::where('id', $id)->update(['views' => $singledog->views + 1]);
                viewers::create(['item_id' => $id, 'user_id' => $userId, 'item_type' => 'dogs']); 
            }
        }

        $users = User::all();

        $success['singledog'] = $singledog;
        $success['dogs'] = $dogs;
        $success['previous'] = $previous;
        $success['next'] = $next;
        $success['previousName'] = $previousName;
        $success['nextName'] = $nextName;
        $success['ratingForm'] = $ratingForm;
        $success['wishlistForm'] = $wishlistForm;
        $success['users'] = $users;
        
        return $this->sendResponse($success, 'get data is successfully.');
    }
    
    
    public function showSingleGuide($id,$type,$userId)
    {
       $guide = guide::select()->where('type',$type)->find($id);
     
       $previous = guide::where('active',1)->where('id', '<', $guide->id)->where('type',$type)->max('id');
       $previousName = guide::where('active',1)->select('name')->find($previous);
       $next = guide::where('active',1)->where('id', '>', $guide->id)->where('type',$type)->min('id');
       $nextName = guide::where('active',1)->select('name')->find($next);
       $guides = guide::where('active',1)->where('type',$type)->inRandomOrder()->limit(3)->get();

       $ratingUsers = DB::table('ratings')->select('user_id')->where('rateable_type','App\guide')->where('rateable_id',$id)->get();
       $ratingUsersId = array();
       foreach ($ratingUsers as $s) {
           array_push($ratingUsersId,$s->user_id);
       };
       $ratingForm;
       if (in_array($userId,$ratingUsersId)){ $ratingForm = true; }
       else{ $ratingForm = false; }

       $typeGuide = $type;

       if($userId !== null){
            $viewersUsers = DB::table('viewers')->select('user_id')->where('item_type','guides')->where('item_id',$id)->get();
            $viewersUsersId = array();
            foreach ($viewersUsers as $v) {
                array_push($viewersUsersId,$v->user_id);
            };
            $addViewe;
            if (in_array($userId,$viewersUsersId)){ $addViewe = true; }
            else{ $addViewe = false; }
            if(!$addViewe){
                guide::where('id', $id)->update(['views' => $guide->views + 1]);
                viewers::create(['item_id' => $id, 'user_id' => $userId, 'item_type' => 'guides']); 
            }
       }

       $smsUsers = DB::table('send_sms_phones')->select('user_id')->where('item_type','clinic')->where('item_id',$id)->get();
       $smsUsersId = array();
       foreach ($smsUsers as $m) {
           array_push($smsUsersId,$m->user_id);
       };
       $smsForm;
       if (in_array($userId,$smsUsersId)){ $smsForm = true; }
       else{ $smsForm = false; }

       $businessHours = BusinessHours::where('item_id',$id)->get();

       $users = User::all();
       
       $success['guide'] = $guide;
       $success['guides'] = $guides;
       $success['previous'] = $previous;
       $success['next'] = $next;
       $success['previousName'] = $previousName;
       $success['nextName'] = $nextName;
       $success['ratingForm'] = $ratingForm;
       $success['typeGuide'] = $typeGuide;
       $success['smsForm'] = $smsForm;
       $success['businessHours'] = $businessHours;
       $success['users'] = $users;
        
       return $this->sendResponse($success, 'get data is successfully.');
                         
   }
    
    
    
    
}