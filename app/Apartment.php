<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\UsingService;

class Apartment extends Model
{
    public function users(){
        return $this->hasMany('App\User');
    }

    public function usingServices(){
        return $this->hasMany(UsingService::class);
    }
}
