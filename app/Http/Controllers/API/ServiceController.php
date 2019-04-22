<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\Http\Resources\Service\ServiceResource;

class ServiceController extends Controller
{
    public function show($id){
        $service = Service::find($id);

        if($service != null){
            $response = [
                'success' => true,
                'message' => 'Service show',
                'data' => new ServiceResource($service)
            ];

            return $response;

        }else{
            $response = [
                'failed' => true,
                'message' => 'Invailid Service ID'
            ];

            return $response;
        }
    }
}
