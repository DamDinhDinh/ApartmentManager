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
        $value = $request->bearerToken();
        if ($value) {
 
            $id = (new Parser())->parse($value)->getHeader('jti');
            $revoked = DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => 1]);
        }
        return Response(['code' => 200, 'message' => 'You are successfully logged out'], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            return new UserResource($user);
        }else{
            $response = [
                'error' => 'User ID not found'
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
    public function update(UserRequest $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user != null){
            if($user->delete()){
                return response()->json([
                    'messages' => 'DELETED user ID: '.$user->id." user name ".$user->name
                    ]);
            }else{
                return response()->json([
                    'failures' => 'Can not excute!'
                    ]);
            }
        }else{
            return response()->json([
                'failures' =>'Invailid user ID'
                ]);
        }

    }
}
