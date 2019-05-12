<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UsingService;

class Service extends Model
{
    protected $fillable = [
        'name',
        'price|float',
        'type|int',
        'payment_method|number',
        'use_method|number',
        'description|text'
    ];

    public function usingServices(){
        return $this->hasMany(UsingService::class);
    }
}
