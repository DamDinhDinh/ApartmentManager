<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UsingService;
use App\Http\Resources\UsingService\UsingServiceResource;

class UsingServiceController extends Controller
{
    public function show($apartment, $usingService){
        $usingService = UsingService::find($usingService);

        if($usingService != null){
            $response = [
                'success' => true,
                'message' => 'Using Service show',
                'data' => new UsingServiceResource($usingService)
            ];

            return $response;

        }else{
            $response = [
                'failed' => true,
                'message' => 'Invailid Using Service ID'
            ];

            return $response;
        }
    }
}
