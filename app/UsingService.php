<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Apartment;
use App\Service;
use App\Model\UseData;

class UsingService extends Model
{
    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function useDatas(){
        return $this->hasMany(UseData::class)->orderBy('use_date', 'DESC');;
    }

}
