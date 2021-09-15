<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Testimonial;
use App\BusinessHours;
use App\Selldogs;
use App\viewers;
use App\Slide;
use App\guide;
use App\User;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Session;
use Carbon\Carbon;
use DB;

class PagesController extends Controller
{
    public function index()
    {
        $dogs = Selldogs::where('active',1)->inRandomOrder()->limit(8)->get();
        $slides = Slide::where('active',1)->orderBy('id', 'desc')->get();
        $testimonials = Testimonial::where('active',1)->orderBy('id', 'desc')->get();
        return view('front.home',compact('dogs','slides','testimonials'));
    }

    public function show($id)
    {
        $singledog = Selldogs::select()->find($id);
        if (!$singledog) {
            return redirect()->route('home');
        } 
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
        if (in_array(Auth::id(),$ratingUsersId)){ $ratingForm = true; }
        else{ $ratingForm = false; }

        $wishlistUsers = DB::table('wishlists')->select('user_id')->where('item_type','dogs')->where('item_id',$id)->get();
        $wishlistUsersId = array();
        foreach ($wishlistUsers as $s) {
            array_push($wishlistUsersId,$s->user_id);
        };
        $wishlistForm;
        if (in_array(Auth::id(),$wishlistUsersId)){ $wishlistForm = true; }
        else{ $wishlistForm = false; }

        if(Auth::id() !== null){
            $viewersUsers = DB::table('viewers')->select('user_id')->where('item_type','dogs')->where('item_id',$id)->get();
            $viewersUsersId = array();
            foreach ($viewersUsers as $v) {
                array_push($viewersUsersId,$v->user_id);
            };
            $addViewe;
            if (in_array(Auth::id(),$viewersUsersId)){ $addViewe = true; }
            else{ $addViewe = false; }
            if(!$addViewe){
                Selldogs::where('id', $id)->update(['views' => $singledog->views + 1]);
                viewers::create(['item_id' => $id, 'user_id' => Auth::id(), 'item_type' => 'dogs']); 
            }
        }

        $users = User::all();

        return view('front.single', compact('singledog','dogs','previous','next','previousName','nextName','ratingForm','wishlistForm','users'));
    }

    public function allPets()
    {
        $dogs = Selldogs::where('active',1)->groupBy('purpose')->get();
        return view('front.allPets',compact('dogs'));
    }

    public function allDogs()
    {
        $dogs = Selldogs::where('active',1)->orderBy('id', 'desc')->paginate(PAGINATION_COUNT_USER);
        return view('front.dogslist',compact('dogs'));
    }

    public function filterDogs($type)
    {
        $dogs = Selldogs::where('active',1)->where('purpose',$type)->orderBy('id', 'desc')->paginate(PAGINATION_COUNT_USER);
        return view('front.dogslist',compact('dogs'));
    }

    public function about()
    {
        return view('front.aboutus');
    }

    public function contact()
    {
        return view('front.contactus');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('info@vetopetocare.com')->send(new ContactFormMail($data));
        Session::flash('success', 'شكرا على رسالتك. سنكون على اتصال.');
        return view('front.contactus');
    }


   // Our Service
   public function clinic()
   {
     $clinics = guide::where('active',1)->where('type',2)->orderBy('id', 'desc')->paginate(PAGINATION_COUNT_USER);
     return view('front.ourService.clinic',compact('clinics'));
   }

   public function pharmacy()
   {
     $pharmacys = guide::where('active',1)->where('type',3)->orderBy('id', 'desc')->paginate(PAGINATION_COUNT_USER);
     return view('front.ourService.pharmacy',compact('pharmacys'));
   }

   public function market()
   {
     $markets = guide::where('active',1)->where('type',4)->orderBy('id', 'desc')->paginate(PAGINATION_COUNT_USER);
     return view('front.ourService.market',compact('markets'));
   }

   public function company()
   {
     $companys = guide::where('active',1)->where('type',5)->orderBy('id', 'desc')->paginate(PAGINATION_COUNT_USER);
     return view('front.ourService.company',compact('companys'));
   }

   public function school()
   {
     $schools = guide::where('active',1)->where('type',6)->orderBy('id', 'desc')->paginate(PAGINATION_COUNT_USER);
     return view('front.ourService.school',compact('schools'));
   }

   //single guide
   public function singleGuide($id,$type)
   {
       $guide = guide::select()->where('type',$type)->find($id);
       if (!$guide) {
           return redirect()->route('home');
       } 
       
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
       if (in_array(Auth::id(),$ratingUsersId)){ $ratingForm = true; }
       else{ $ratingForm = false; }

       $typeGuide = $type;

       if(Auth::id() !== null){
            $viewersUsers = DB::table('viewers')->select('user_id')->where('item_type','guides')->where('item_id',$id)->get();
            $viewersUsersId = array();
            foreach ($viewersUsers as $v) {
                array_push($viewersUsersId,$v->user_id);
            };
            $addViewe;
            if (in_array(Auth::id(),$viewersUsersId)){ $addViewe = true; }
            else{ $addViewe = false; }
            if(!$addViewe){
                guide::where('id', $id)->update(['views' => $guide->views + 1]);
                viewers::create(['item_id' => $id, 'user_id' => Auth::id(), 'item_type' => 'guides']); 
            }
       }

       $smsUsers = DB::table('send_sms_phones')->select('user_id')->where('item_type','clinic')->where('item_id',$id)->get();
       $smsUsersId = array();
       foreach ($smsUsers as $m) {
           array_push($smsUsersId,$m->user_id);
       };
       $smsForm;
       if (in_array(Auth::id(),$smsUsersId)){ $smsForm = true; }
       else{ $smsForm = false; }

       $businessHours = BusinessHours::where('item_id',$id)->get();

       $users = User::all();

       return view('front.ourService.singleGuide', compact('guide','guides','previous','next','previousName','nextName','ratingForm','typeGuide','smsForm','businessHours','users'));
                         
   }
   
    //privacy policy
    public function privacyPolicy()
    {
        return view('front.privacy-policy');
    }
    
    
    public function search(Request $request){
        
        if($request->ajax()) {
          
            $data = Selldogs::where('strain', 'LIKE', $request->country.'%')
                ->limit(5)->get();
           
            $output = '';
            if (count($data)>0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row){
                  foreach (json_decode($row->filename) as $key => $file){
                      if ($key == 0){
                        $output .= '<li class="list-group-item"><a style="color:#000;font-weight: bold;" href="/single/'.$row->id.'"><img style="padding: 5px;width: 50px;border-radius: 10px;" src="/assets/'.$file.'"/>'.$row->strain.'</a></li>';
                      }
                  }
                }
                $output .= '</ul>';
            }
            else {}
            return $output;
        }
    }

   

}
