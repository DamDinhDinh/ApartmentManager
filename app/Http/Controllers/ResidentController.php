<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\User;

class ResidentController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'apartment' => 'required|int',
            'user' => 'required|int'
        ]);

        $userID = $request->user;
        $apartmentID = $request->apartment;
        
        $apartment = Apartment::find($apartmentID);
        $user = User::find($userID);

        if(($user && $apartment) != null){
            if($user->apartment == null){
                $user->apartment_id = $apartmentID;
                if($user->save()){
                    $response = [
                        'success' => true,
                        'message' => 'Added user'
                    ];
    
                    return response($response);
                }else{
                    $response = [
                        'error' => true,
                        'errorType' => 3,
                        'message' => 'Can not excute',
                    ];
                }

            }else{
                $response = [
                    'error' => true,
                    'errorType' => 2,
                    'message' => 'Already have apartment',
                ];

                return response($response);
            }
        }else{
            $response = [
                'error' => true,
                'errorType' => 1,
                'message' => 'Invailid user id or apartment id',
            ];

            return response($response);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
