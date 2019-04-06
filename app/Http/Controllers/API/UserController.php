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
                    'success' => 'Success login',
                    'bearer_token' => $token
                ];

                return response($response, 200);
            }else{
                $response = [
                    'error' => 'Password not match'
                ];

                return response($response, 422);
            }
        }else{
            $response = [
                'error' => 'Email does not exist'
            ];

            return response($response, 422);
        }
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        $response = [
            'success' => 'You are successfully logged out'
        ];

        return Response($response, 200);
    }

    public function index(Request $request){
        $user_id = $request->user()->id;
        $user = User::find($user_id);

        if($user != null){
            return new UserResource($user);
        }else{
            $response = [
                'error' => 'User ID not found'
            ];

            return response($response, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $user = User::find($id);
        
    //     if($user != null){
    //         return new UserResource($user);
    //     }else{
    //         $response = [
    //             'error' => 'User ID not found'
    //         ];

    //         return response($response, 404);
    //     }   
    // }

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

        $user->update($request->all());
        return $user = User::find($user_id);;
    }

}
