<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Notification;
use App\Http\Resources\Notification\NotificationResource;
use App\Http\Resources\Notification\NotificationCollection;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::all();

        if(count($notifications) > 0){
            $response = [
                'success' => true,
                'message' => 'List notification',
                'data' => NotificationCollection::collection($notifications)
            ];

            return $response;
        }else if(count($notifications) == 0){
            $response = [
                'failed' => true,
                'message' => 'Doe not have any notification',
            ];

            return $response;
        }else{
            $response = [
                'failed' => true,
                'message' => trans('messages.cant_excute'),
            ];

            return $response;
        }
    }

    public function show($id){
        $notification = Notification::find($id);

        if($notification != null){
            $response = [
                'success' => true,
                'message' => 'Show notification',
                'data' => new NotificationResource($notification)
            ];

            return $response;
        }else{ 
            $response = [
                'failed' => true,
                'message' => 'Invailid notification ID'
            ];

            return $response;
        }
    }
}
