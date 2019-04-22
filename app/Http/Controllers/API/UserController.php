<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Parser;
use DB;

class UserController extends Controller
{
    public function login(LoginRequest $request){
        $user = User::where('email', $request->email)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;

                $response = [
                    'success' => true,
                    'message' => 'Loged in',
                    'data' => new UserResource($user),
                    'bearer_token' => $token
                ];

                return response($response, 200);
            }else{
                $response = [
                    'failed' => true,
                    'message' => 'Password not match'
                ];

                return response($response, 422);
            }
        }else{
            $response = [
                'failed' => true,
                'message' => 'Email does not exist'
            ];

            return response($response, 422);
        }
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        $response = [
            'success' => true,
            'message' => 'Logged out'
        ];

        return Response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        if($user != null){
            $response = [
                'success' => true,
                'message' => 'User show',
                'data' => new UserResource($user)
            ];
            return $response;
        }else{
            $response = [
                'failed' => true,
                'message' => 'User ID not found'
            ];

            return response($response, 404);
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id = $request->user()->id;
        $user = User::find($user_id);
        
        if($request->password != null){
            $request->password = Hash::make($request->password);
        }
        
        $user->update($request->all());
        
        $response = [
            'success' => true,
            'message' => 'Updated user',
            'data' => new UserResource($user)
        ];
    }

}
