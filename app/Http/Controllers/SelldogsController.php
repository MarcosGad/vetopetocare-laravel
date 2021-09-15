<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Selldogs;
use App\wishlist;
use Redirect;
use DB;

class SelldogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
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
            'filename' =>  ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ],[
            'required'  => 'هذا الحقل مطلوب',
        ]);
        
        if($request->hasfile('filename'))
         {

            foreach($request->file('filename') as $image)
            {
                /*
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/', $name);  
                */
                $filePath = uploadImage('license', $image);
                $data[] = $filePath;  
            }
         }

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
         //$Selldogs->active= 0;
         $Selldogs->user_id= Auth::id();
         $Selldogs->filename=json_encode($data);
         $Selldogs->notes= $request->notes;
         $Selldogs->save();

        //return back()->with('success', 'تم الأضافة');
        return Redirect::route('displayed');
    }

    public function rating(Request $request)
    {
        request()->validate(['rate' => 'required']);
        $dog = Selldogs::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $dog->ratings()->save($rating);
        return response($dog);
    }

    public function wishlist(Request $request)
    {
        request()->validate(['id' => 'required']);
        $wishlist = wishlist::create(['item_id' => $request->id, 'user_id' => Auth::id(), 'item_type' => 'dogs']);
        return response($wishlist); 
    }

    public function deleteWishlist(Request $request)
    {
        $wishlist = DB::table('wishlists')->where('item_id', $request->id)->where('user_id', Auth::id())->where('item_type', 'dogs')->delete();
        return response($wishlist); 
    }

    public function getWishlist()
    {
        $wishlistItem = DB::table('wishlists')->select('item_id')->where('item_type','dogs')->where('user_id',Auth::id())->get();
        $wishlistItemId = array();
        foreach ($wishlistItem as $i) {
            array_push($wishlistItemId,$i->item_id);
        };        
        $dogs = Selldogs::where('active',1)->whereIn('id', $wishlistItemId)->get();
        return view('front.wishlist',compact('dogs'));
    }

    public function destroyGetWishlist($id){
        $wishlist = DB::table('wishlists')->where('item_id', $id)->where('user_id', Auth::id())->where('item_type', 'dogs')->delete();
        return redirect()->back();
    }


    //Accessories
    public function addAccessories(Request $request)
    {
        $this->validate($request,[
            'address' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'filename' =>  ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ],[
            'required'  => 'هذا الحقل مطلوب',
        ]);
        
        if($request->hasfile('filename'))
         {
            foreach($request->file('filename') as $image)
            {
                $filePath = uploadImage('license', $image);
                $data[] = $filePath;  
            }
         }

         $Selldogs= new Selldogs();
         $Selldogs->purpose= 'مستلزمات';
         $Selldogs->address= $request->address;
         $Selldogs->price= $request->price;
         $Selldogs->user_id= Auth::id();
         $Selldogs->filename=json_encode($data);
         $Selldogs->notes= $request->notes;
         $Selldogs->save();

        //return back()->with('success', 'تم الأضافة');
        return Redirect::route('displayed');
    }
}
