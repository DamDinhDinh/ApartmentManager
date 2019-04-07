<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Apartment;
use App\Service;

class UsingService extends Model
{
    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
