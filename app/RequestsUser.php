<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestsUser extends Model
{
    protected $guarded = [];

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
