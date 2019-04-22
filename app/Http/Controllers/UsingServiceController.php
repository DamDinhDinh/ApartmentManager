<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
Use App\Apartment;
use App\UsingService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request as Request1;
use App\Model\UseData;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UsingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usingServices = UsingService::all();

        return view('manager.usingService.index')->with('usingServices', $usingServices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.usingService.create');
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
            'service' => 'required|int',
            'start_date' => 'required|date',
            'use_value' => 'required|int',
            'use_date' => 'required|date',
        ]);

        $serviceID = $request->service;
        $apartmentID = $request->apartment;
        $apartment = Apartment::find($apartmentID);
        $service = Service::find($serviceID);

        if(($service && $apartment) != null){
            $usingService = new UsingService;
            $usingService->service_id = $serviceID;
            $usingService->apartment_id = $apartmentID;
            $usingService->start_date = $request->start_date;

            if($usingService->service->payment_method ==  1){
                if($usingService->service->use_method == 1){
                    $usingService->expire_date = $request->start_date;
                    //create bill
                }else if($usingService->service->use_method == 2){
                    $expire = Carbon::parse($request->start_date);
                    $expire->addDays(30);
                    $usingService->expire_date = $expire;
                }
                
                
            }else if($usingService->service->payment_method ==  2){
                if($usingService->service->use_method == 1){
                    $usingService->expire_date = $request->start_date;
                    //create bill
                }else if($usingService->service->use_method == 2){
                    $expire = Carbon::parse($request->start_date);
                    $expire->addDays(1);
                    $usingService->expire_date = $expire;
                }
            }

            if($usingService->save()){
                $useData = new UseData;
                $useData->using_service_id = $usingService->id;
                $useData->use_date = $request->use_date;
                $useData->use_value_prev = $useData->prevMonthValue();
                $useData->use_value_curr = $request->use_value;
                if($usingService->service->use_method == 1){
                    $useData->use_value = $useData->use_value_curr;
                }else if($usingService->service->use_method == 2){
                    $useData->use_value = $useData->use_value_curr - $useData->use_value_prev;
                }

                if($useData->save()){
                    if(!$request->ajax()){
                        return back()->with('messages', ['ADDED service']);
                    }else{
                        $response = [
                            'success' => true,
                            'message' => 'Added service'
                        ];
            
                        return response($response);
                    } 
                    
                }else{
                    if(!$request->ajax()){
                        return back()->with('failures', ['Can not excute!']);
                    }
                    $response = [
                        'error' => true,
                        'errorType' => 3,
                        'message' => 'Can not excute',
                    ];
                }
                
            }else{
                if(!$request->ajax()){
                    return back()->with('failures', ['Can not excute!']);
                }
                $response = [
                    'error' => true,
                    'errorType' => 3,
                    'message' => 'Can not excute',
                ];
            }
        }else{
            if(!$request->ajax()){
                return back()->with('failures', ['Invailid apartment ID or service ID']);
            }
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
        $usingService = UsingService::find($id);
        if($usingService != null){
            return view('manager.usingService.show')->with('usingService', $usingService);
        }else{
            return back()->with('failures', ['Invailid using service ID']);
        }
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
                    return back()->with('messages', ['DELETED service']);
                }
                $response = [
                    'success' => true,
                    'message' => 'Delete service'
                ];
    
                return response($response);
            }else{
                if(!$request->ajax()){
                    return back()->with('failures', ['Can not excute!']);
                }
                $response = [
                    'error' => true,
                    'errorType' => 3,
                    'message' => 'Can not excute',
                ];
            }
        }else{
            if(!$request->ajax()){
                return back()->with('failures', ['Invailid using service ID']);
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
