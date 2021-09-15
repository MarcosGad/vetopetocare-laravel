<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use DB;

   
class CscController extends BaseController
{
   
    public function countries()
    {
         $country_list = DB::table('country_state_city')->where('active',1)->groupBy('country')
         ->get();
            $success['countries'] = $country_list; 
            return $this->sendResponse($success, 'Done.');
    }
    
    
    public function states($countries)
    {
       $data = DB::table('country_state_city')
       ->where('active',1)
       ->where('country', $countries)
       ->groupBy('state')
       ->get();
       
        $success['states'] = $data; 
        return $this->sendResponse($success, 'Done.');
    }
    
    public function cities($states)
    {
        $data = DB::table('country_state_city')
       ->where('active',1)
       ->where('state', $states)
       ->groupBy('city')
       ->get();
       
        $success['cities'] = $data; 
        return $this->sendResponse($success, 'Done.');
    }
    
    
}