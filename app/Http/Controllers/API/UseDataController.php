<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UseData;
use App\Http\Resources\UseData\UseDataResource;

class UseDataContoller extends Controller
{
    public function show($id){
        $useData = UseData::find($id);

        if($useData != null){
            $response = [
                'success' => true,
                'message' => 'Use Data show',
                'data' => new UseDataResource($useData)
            ];

            return $response;

        }else{
            $response = [
                'failed' => true,
                'message' => 'Invailid Use Data ID'
            ];

            return $response;
        }
    }
}
