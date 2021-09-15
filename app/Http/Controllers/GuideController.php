<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationUser;
use App\Mail\Clinic;
use Twilio\Rest\Client;
use App\SendSmsPhone;
use App\BusinessHours;
use Redirect;
use App\User;
use App\guide;

class GuideController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('front.addGuides');
    }

    public function create(){}
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'filename' =>  ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            'landline_phone' => ['required', 'string', 'max:11'],
            'offers_services' => ['required', 'string'],
        ],[
            'required'  => 'هذا الحقل مطلوب',
            'phone.max'  => 'هذا عدد لرقم التليفون 11 رقم',
        ]);
        
        if($request->hasfile('filename'))
         {
            foreach($request->file('filename') as $image)
            {
                $filePath = uploadImage('license', $image);
                $data[] = $filePath;  
            }
         }

         $guide= new guide();
         $guide->name= $request->name;
         $guide->filename=json_encode($data);
         $guide->address= $request->address;
         $guide->phone= $request->phone;

         $guide->landline_phone= $request->landline_phone;
         $guide->yes_or_no= $request->yes_or_no;
         $guide->yes_or_no_two= $request->yes_or_no_two;
         $guide->home_detection_rate= $request->home_detection_rate;
         $guide->regular_check_up_price= $request->regular_check_up_price;
         $guide->doctor_name= $request->doctor_name;
         $guide->price_of_the_delivery_service= $request->price_of_the_delivery_service;

         $guide->offers_services= $request->offers_services;
         $guide->type= auth()->user()->type;
         $guide->user_id= Auth::id();
         $guide->active= 0;
         $guide->save();


         if($request->has('weekDay') && $request->has('start_time') && $request->has('end_time')){
            foreach( $request->weekDay as $key => $n ) {
                if($request->start_time[$key] && $request->end_time[$key] != 'off'){
                   BusinessHours::create(['weekDay' => $n, 'start_time' => $request->start_time[$key], 'end_time' => $request->end_time[$key], 'item_id' => $guide->id, 'user_id' => Auth::id()]); 
                }            }
            //return back()->with('success', 'تم الأضافة');
            return Redirect::route('displayed');
         }

        //return back()->with('success', 'تم الأضافة');
        return Redirect::route('displayed');

    }

    public function ratingGuide(Request $request)
    {
        request()->validate(['rate' => 'required']);
        $guide = guide::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $guide->ratings()->save($rating);
        return response($guide);
    }

    //send sms or email 
    public function sendSMS(Request $request)
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
        return response()->json(array('success' => true));

        // $to = '+2001026880555';
        // $message = $request->mass;

        // $accountSid = 'ACf53a8c23c78a600fbefe220c5f4feef6';
        // $authToken = 'e9d6bbbfd8c8f1ef0de76b224d269568';
        // $twilioNumber = '+12058585531';
        // try {
        //     $client = new Client($accountSid, $authToken);
        //     $client->messages->create(
        //         $to, [
        //             "body" => $message,
        //             "from" => $twilioNumber,
        //         ]
        //     );
        //     //return response($client);
        //     SendSmsPhone::create(['item_id' => $request->id, 'user_id' => Auth::id(), 'mass' => $request->mass ,'item_type' => 'clinic']);
        //     return response()->json(array('success' => true));
        // } catch (TwilioException $e) {
        //     dd($e);
        // } 
    }
    


}
