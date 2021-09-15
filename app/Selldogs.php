<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Selldogs extends Model
{
    use Rateable;

    protected $guarded = []; 

    public function getActive(){
        return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
    }
}
