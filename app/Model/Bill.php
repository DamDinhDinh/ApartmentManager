<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UseData;
use App\User;
use App\UsingService;

class Bill extends Model
{
    public function useData(){
        return $this->belongsTo(UseData::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function usingService(){
        return $this->belongsTo(UsingService::class);
    }
}
