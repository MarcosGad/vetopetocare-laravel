<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = []; 

    public function getActive(){
        return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
    }
}
