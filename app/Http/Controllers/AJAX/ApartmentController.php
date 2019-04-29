<?php

namespace App\Http\Controllers\AJAX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Apartment\ApartmentCollection;
use App\Apartment;

class ApartmentController extends Controller
{
   public function index(){
        if(true){
            return datatables()->of(ApartmentCollection::collection(Apartment::all()))->make(true);
        }
   }
}
