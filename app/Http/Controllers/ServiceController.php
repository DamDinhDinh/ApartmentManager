<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
Use App\Http\Requests\ServiceRequest;
Use App\Http\Resources\Service\ServiceCollection;

class ServiceController extends Controller
{
    public function __construct(){
        $this->middleware('manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('name', 'ASC')->paginate(10);
        return view('manager.service.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.service.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service;
        $service->name = $request->name;
        $service->type = $request->type;
        $service->price = $request->price;
        $service->payment_method = $request->payment_method;
        $service->use_method = $request->use_method;
        $service->description = $request->description;
        
        // 
        if($service->save()){
            return redirect()->route('service.show', $service->id)->with('messages', ['CREATED service: '.$service->name." description: ".$service->description]); 
        }else{
            return redirect()->route('service.index')->with('failures', ['Can not excute!']);
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
        $service = Service::find($id);
        if($service != null){
            return view('manager.service.show')->with('service', $service);
        }else{
            return redirect()->route('service.index')->with('failures', ['Invailid service ID']);
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
        $service = Service::find($id);

        if($service != null){
            return view('manager.service.edit')->with('service', $service);
        }else{
            return redirect()->route('service.index')->with('failures', ['Invailid service ID']);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $service = Service::find($id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->type = $request->type;
        $service->payment_method = $request->payment_method;
        $service->use_method = $request->use_method;
        $service->description = $request->description;


        if($service->save()){
            return redirect()->route('service.show', $service->id)->with('messages', ['UPDATED service: '.$service->name." description: ".$service->description]); 
        }else{
            return redirect()->route('service.index')->with('failures', ['Can not excute!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if($service != null){
            if($service->delete()){
                return redirect()->route('service.index')->with('messages', ['DELETED service: '.$service->name]);
            }else{
                return redirect()->route('service.index')->with('failures', ['Can not excute!']);
            }
        }else{
            return redirect()->route('service.index')->with('failures', ['Invailid service ID']);
        }
    }

    public function search(Request $request){
        $services = Service::where('name','LIKE','%'.$request->search.'%')->get();
        $services = ServiceCollection::collection($services);
        if(count($services) > 0){
            $response = [
                'success' => true,
                'data' => $services,
            ];

            return response($response);
        }else{
            $response = [
                'success' => true,
                'data' => 'none',
            ];

            return response($response);
        }
    }
}
