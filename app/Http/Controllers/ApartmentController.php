<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Http\Requests\ApartmentRequest;
use DB;

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
            return redirect()->route('apartment.index')->with('messages', [trans('messages.create_success')]);
        }else{
            return redirect()->route('apartment.index')->with('failures', [trans('messages.cant_excute')]);
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
            return redirect()->route('apartment.index')->with('failures', [trans('messages.not_exist')]);
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
            return redirect()->route('apartment.index')->with('failures', [trans('messages.not_exist')]);
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
            return redirect()->route('apartment.show', $apartment->id)->with('messages', [trans('messages.update_success')]);
        }else{
            return redirect()->route('apartment.show', $apartment->id)->with('failures', [trans('messages.cant_excute')]);
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
                return redirect()->route('apartment.index')->with('messages', [trans('messages.delete_success')]);
            }else{
                return redirect()->route('apartment.index')->with('failures', [trans('messages.cant_excute')]);
            }
        }else{
            return redirect()->route('apartment.index')->with('failures', [trans('messages.not_exist')]);
        }
    }


    public function search(Request $request){

        $apartments = Apartment::where('name','LIKE','%'.$request->search.'%')->get();

        if(count($apartments) > 0){
            $response = [
                'success' => true,
                'data' => $apartments,
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
