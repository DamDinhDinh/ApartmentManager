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

    public function paid(Request $request){

        $request->validate([
            'user_name' => 'required',
        ]);
        
        $bill = Bill::find($request->bill);

    
        if($bill != null){
            if($bill->status == 0){
                $result = $bill->doPayment($request->user_name, 2, date("Y-m-d h:i:s"));

                if($result == 1){
                    $response = [
                        'success' => true,
                        'message' => 'Bill paid complete',
                        'data' => new BillResource($bill)
                    ];
    
                    return $response;
                }else if($result == -2){
                    $response = [
                        'failed' => true,
                        'message' => trans('messages.cant_excute'),
                    ];
        
                    return $response;
                }else if($result == -1){
                    $response = [
                        'failed' => true,
                        'message' => 'Invailid user name',
                    ];
        
                    return $response;
                }
            }else{
                $response = [
                    'failed' => true,
                    'message' => 'Bill paid already',
                ];
    
                return $response;
            }

           
        }else{
            $response = [
                'failed' => true,
                'message' => 'Invailid bill ID'
            ];

            return $response;
        }
    }
}
