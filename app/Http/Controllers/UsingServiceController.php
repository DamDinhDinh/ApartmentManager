<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
Use App\Apartment;
use App\UsingService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request as Request1;

class UsingServiceController extends Controller
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
        $request->validate([
            'apartment' => 'required|int',
            'service' => 'required|int'
        ]);

        $serviceID = $request->service;
        $apartmentID = $request->apartment;
        
        $apartment = Apartment::find($apartmentID);
        $service = Service::find($serviceID);
        $usingService = new UsingService;

        if(($service && $apartment) != null){
            $usingService = new UsingService;
            $usingService->service_id = $serviceID;
            $usingService->apartment_id = $apartmentID;
            $usingService->start_date = Carbon::now();
            $usingService->expire_date = Carbon::now();

            if($usingService->save()){
                $response = [
                    'success' => true,
                    'message' => 'Added service'
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
                'errorType' => 1,
                'message' => 'Invailid service id or apartment id',
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
    public function destroy(Request $request)
    {
        $request->validate([
            'apartment' => 'required|int',
            'usingService' => 'required|int'
        ]);

        $apartmentID = $request->apartment;
        $id = $request->usingService;

        $usingService = UsingService::find($id);
        if(($usingService) != null){
            if($usingService->delete()){
                if(!$request->ajax()){
                    return redirect()->route('apartment.show', $apartmentID)->with('messages', ['DELETED service']);
                }
                $response = [
                    'success' => true,
                    'message' => 'Delete service'
                ];
    
                return response($response);
            }else{
                if(!$request->ajax()){
                    return redirect()->route('apartment.show', $apartmentID)->with('failures', ['Can not excute!']);
                }
                $response = [
                    'error' => true,
                    'errorType' => 3,
                    'message' => 'Can not excute',
                ];
            }
        }else{
            if(!$request->ajax()){
                return redirect()->route('apartment.show', $apartmentID)-with('failures', ['Invailid using service ID']);
            }
            $response = [
                'error' => true,
                'errorType' => 1,
                'message' => 'Invailid service id or apartment id',
            ];

            return response($response);
        }
    }
}
