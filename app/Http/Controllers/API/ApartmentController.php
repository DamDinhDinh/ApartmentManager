<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Apartment\ApartmentResource;
use App\Http\Resources\Apartment\ApartmentCollection;
use App\Apartment;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [
            'success' => true,
            'message' => 'Apartment list',
            'data' => ApartmentCollection::collection(Apartment::all())
        ];
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::find($id);

        if($apartment != null){
            $response = [
                'success' => true,
                'message' => 'Apartment show',
                'data' => new ApartmentResource($apartment)
            ];
    
            return $response;
        }else{
            $response = [
                'failed' => true,
                'message' => 'Invailid apartment ID'
            ];
    
            return $response;
        }
       
    }
}
