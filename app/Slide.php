<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $guarded = []; 

    public function getActive(){
        return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
    }

    public function getFilenameAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";
    }
}
