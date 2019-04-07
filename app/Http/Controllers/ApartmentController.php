<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Http\Requests\ApartmentRequest;


class ApartmentController extends Controller
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
        $apartmentList = Apartment::orderBy('name', 'ASC')->paginate(10);
        return view('manager.apartment.index')->with('apartmentList', $apartmentList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.apartment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentRequest $request)
    {
        $apartment = new Apartment();
        $apartment->name = $request->name;
        $apartment->address = $request->address;
        
        if($apartment->save()){
            return redirect()->route('apartment.index')->with('messages', ['CREATED apartment: '.$apartment->name." address: ".$apartment->address]);
        }else{
            return redirect()->route('apartment.index')->with('failures', ['Can not excute!']);
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
        $apartment = Apartment::find($id);
        if($apartment != null){
            return view('manager.apartment.show')->with('apartment', $apartment);
        }else{
            return redirect()->route('apartment.index')->with('failures', ['Invailid apartment ID']);
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
        $apartment = Apartment::find($id);

        if($apartment != null){
            return view('manager.apartment.edit')->with('apartment', $apartment);
        }else{
            return redirect()->route('apartment.index')->with('failures', ['Invailid apartment ID']);
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentRequest $request, $id)
    {
        $apartment = Apartment::find($id);
        $apartment->name = $request->name;
        $apartment->address = $request->address;

        if($apartment->save()){
            return redirect()->route('apartment.index')->with('messages', ['UPDATED apartment: '.$apartment->name." address: ".$apartment->address]);
        }else{
            return redirect()->route('apartment.index')->with('failures', ['Can not excute!']);
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
        $apartment = Apartment::find($id);

        if($apartment != null){
            if($apartment->delete()){
                return redirect()->route('apartment.index')->with('messages', ['DELETED apartment: '.$apartment->name." address ".$apartment->address]);
            }else{
                return redirect()->route('apartment.index')->with('failures', ['Can not excute!']);
            }
        }else{
            return redirect()->route('apartment.index')->with('failures', ['Invailid apartment ID']);
        }
    }

    public function removeResident($apartment, $user){
        $user = User::find($user);
        if($user != null){
            if($user->apartment_id != null){
                if($user->apartment_id == $apartment->id){
                    $user->apartment_id = null;
                }
            }
        }else{
            return redirect()->route('apartment.show', $apartment)-with('failures', ['Invailid apartment ID']);
        }
    }

    public function addResident($apartment){
        
    }

    public function removeService($apartment, $user){
        
    }

    public function addService($apartment){
        
    }
}
