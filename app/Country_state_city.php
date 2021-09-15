<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country_state_city extends Model
{
    protected $table = 'country_state_city';

    protected $guarded = [];

    public function getActive(){
        return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
    }
}
