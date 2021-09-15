<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
           'type','name','birth','gender','country','state','city','address','disclosure_price','about_you','license','pharmacy_license','image_of_the_guild_capricorn','Personal_identification_photo','phone','email','password','active','facebook_id','google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getActive(){
        return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
    }

    public function getLicenseAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";
    }

    public function getImageOfTheGuildCapricornAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";
    }

    public function getPersonalIdentificationPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";
    }

    public function getPharmacyLicenseAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";
    }
}
