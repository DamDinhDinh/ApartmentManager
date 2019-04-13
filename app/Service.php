<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
