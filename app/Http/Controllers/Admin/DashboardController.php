<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country_state_city;
use App\RequestsUser;
use App\SendSmsPhone;
use App\Selldogs;
use App\guide;
use App\User;

class DashboardController extends Controller
{
    public function index(){
         $users = User::count();
         $userActive = User::where('active',1)->count();
         $userNotActive = User::where('active',0)->count();
         if($userActive != 0){
            $percentUsers = $userActive / $users * 100;
         }else{
            $percentUsers = '';
         }

         $selldogs = Selldogs::count();
         $selldogsActive = Selldogs::where('active',1)->count();
         $selldogsNotActive = Selldogs::where('active',0)->count();
         if($selldogsActive != 0){
            $percentSelldogs = $selldogsActive / $selldogs * 100;
         }else{
            $percentSelldogs = '';
         }

         $guide = guide::count();
         $guideActive = guide::where('active',1)->count();
         $guideNotActive = guide::where('active',0)->count();
         if($guideActive != 0){
            $percentGuide = $guideActive / $guide * 100;
         }else{
            $percentGuide = '';
         }
         

         $areas = Country_state_city::count();
         $areasActive = Country_state_city::where('active',1)->count();
         $areasNotActive = Country_state_city::where('active',0)->count();
         if($areasActive != 0){
            $percentAreas = $areasActive / $areas * 100;
         }else{
            $percentAreas = '';
         }

         $users = User::count();
         $usersMass= RequestsUser::count();
         if($usersMass != 0){
            $percentUsersMass= $usersMass / $users * 100;
         }else{
            $percentUsersMass = '';
         }

         $clinics = guide::where('active',1)->where('type',2)->count();
         $ClinicReservations = SendSmsPhone::count();
         if($ClinicReservations != 0){
            $percentClinicReservationsFromUser = $ClinicReservations / $users * 100;
         }else{
            $percentClinicReservationsFromUser = '';
         }
    
         return view('admin.dashboard',
         compact('userActive',
         'userNotActive',
         'percentUsers',
         'selldogsActive',
         'selldogsNotActive',
         'percentSelldogs',
         'guideActive',
         'guideNotActive',
         'percentGuide',
         'areasActive',
         'areasNotActive',
         'percentAreas',
         'usersMass',
         'percentUsersMass',
         'clinics',
         'ClinicReservations',
         'percentClinicReservationsFromUser'));
    }
}