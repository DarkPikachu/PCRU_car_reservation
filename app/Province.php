<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    public function task(){
        return $this->belongTo('App\Task','province_code','province_code');
    }
}
