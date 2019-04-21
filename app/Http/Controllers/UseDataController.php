<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\UseData;
use App\UsingService;
use Illuminate\Support\Facades\Input;


class UseDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($usingService)
    {
        $usingServiceID = $usingService;
        $usingService = UsingService::find($usingServiceID);

        if($usingService != null){
            $useDataList = $usingService->useDatas;

            return view('manager.useData.index')->with('useDataList', $useDataList);
        }else{
            return back()->with('failures', ['Invailid using service ID']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.useData.create');
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
            'usingService' => 'required|int',
            'useValue' => 'required|int',
            'useDate' => 'required'
        ]);

        $useData = new UseData;
        $useData->using_service_id = $request->usingService;
        $useData->use_value = $request->useValue;
        $useData->use_date = $request->useDate;
                    
        if($useData->save()){
            if(!$request->ajax()){
                return back()->with('messages', ['ADDED use data']);
            }else{
                if($useData->save()){
                    $response = [
                        'success' => true,
                        'message' => 'ADDED use data'
                    ];
        
                    return response($response);
                } 
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
