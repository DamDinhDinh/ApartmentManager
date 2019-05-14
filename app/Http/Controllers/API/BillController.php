<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Http\Resources\Bill\BillResource;
use App\Http\Resources\Bill\BillCollection;
use App\Apartment;

class BillController extends Controller
{
    public function show($id){
        $bill = Bill::find($id);

        if($bill != null){
            $response = [
                'success' => true,
                'message' => 'Bill show',
                'data' => new BillResource($bill)
            ];

            return $response;

        }else{
            $response = [
                'failed' => true,
                'message' => 'Invailid Bill ID'
            ];

            return $response;
        }
    }

    public function getByApartment($apartment){
        $apartment = Apartment::find($apartment);
        if($apartment != null){
            $bills = $apartment->bills;

            if(count($bills) > 0){
                $response = [
                    'success' => true,
                    'message' => 'Bill show',
                    'data' => BillCollection::collection($bills)
                ];

                return $response;
            }else{
                $response = [
                    'failed' => true,
                    'message' => 'Apartment does not have any bill'
                ];
    
                return $response;
            }
        }else{
            $response = [
                'failed' => true,
                'message' => 'Invailid Apartment ID'
            ];

            return $response;
        }
    }
}
