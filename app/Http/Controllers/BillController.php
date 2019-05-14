<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsingService;
use App\Model\UseData;
use App\Model\Bill;
use App\User;

class BillController extends Controller
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
    public function create($usingService, $useData)
    {
        $usingService = UsingService::find($usingService);
        $useData = UseData::find($useData);
        if(($usingService && $useData) != null){
            return view('manager.bill.create')->with(['usingService' => $usingService, 'useData' => $useData]);
        }else{
            return back()->with('failures', ['Invailid using service ID or use data ID']);
        }
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
            'useData' => 'required|int',
            'useDate' => 'required|date',
            'name' => 'required|',
            'useValue' => 'required|int|min:0',
            'price' => 'required|int|min:0',
            'discount' => 'required|digits_between:0,100',
            'vat' => 'required|digits_between:0,100',
            'sum' => 'required',
            'status' => 'required|int',
        ]);

        $usingService = UsingService::find($request->usingService);
        $useData = UseData::find($request->useData);
        
        if($usingService != null && $useData != null){
            if($useData->bill == null){
                $bill = new Bill;
                $bill->using_service_id = $usingService->id;
                $bill->apartment_id = $usingService->apartment_id;
                $bill->service_id = $usingService->service_id;
                $bill->use_data_id = $useData->id;
                $bill->name = $request->name;
                $bill->use_date = $useData->use_date;
                $bill->use_value = $useData->use_value;
                $bill->price = $usingService->service->price;
                $bill->discount = $request->discount;
                $bill->vat = $request->vat;
                $bill->sum = $this->calculate($bill->use_value, $bill->price, $bill->vat, $bill->discount);
                $bill->status = $request->status;
    
                if($bill->status == 0){
                    if($bill->save()){
                        return redirect()->route('bill.show', ['usingService' => $bill->using_service_id, 'useData' => $bill->use_data_id, 'bill' => $bill->id])->with('messages', [trans('messages.create_success')]);
                    }else{
                        return back()->with('failures', ['Cannot excute']);
                    }
                }else if($bill->status == 1){
                    $request->validate([
                        'user_name' => 'required',
                        'paid_method' => 'required|int',
                        'paid_date' => 'required|date'
                    ]);
    
                    // $user = User::find($request->user_id);
    
                    if(true){

                        // $bill->status = 1;
                        // $bill->user_id = $user->id;
                        // $bill->paid_method = $request->paid_method;
                        // $bill->paid_date = $request->paid_date;
    
                        $result = $bill->doPayment($request->user_name, $request->paid_method, $request->paid_date);

                        if($result){
                            return back()->with('messages', ['Bill created']);
                        }else{
                            return back()->with('failures', ['Cannot excute']);
                        }
                    }else{
                        return back()->with('failures', ['Invailid user ID']);
                    }
                }
            }else{
                return back()->with('failures', ['UseData have bill already.']);
            } 
        }else{
            return back()->with('failures', ['Invailid using service ID or use data ID']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($usingService, $useDatam, $billID)
    {
        $bill = Bill::find($billID);
        if($bill != null){
            return view('manager.bill.show')->with(['bill' => $bill]);
        }else{
            return redirect()->back()->with('messages', [trans('messages.not_exist')]);
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
    public function destroy($id)
    {
        //
    }


    private function calculate($amount, $price, $vat, $discount){
        $cost = $amount * $price;
        $cost = $cost - $cost * $discount/100;
        $cost = $cost + $cost * $vat/100;

        $sum = $cost;
        return $cost;
    }

    public function paid(Request $request){
        $request->validate([
            'user_name' => 'required',
            'paid_method' => 'required|int',
            'paid_date' => 'required|date'
        ]);

        $bill = Bill::find($request->bill);
    
        if($bill != null){
            $result = $bill->doPayment($request->user_name, $request->paid_method, $request->paid_date);

            if($result){
                return back()->with('messages', ['Bill paid succes']);
            }else{
                return back()->with('failures', ['Cannot excute']);
            }
        }else{
            return back()->with('failures', ['Invailid bill ID']);
        }
    }

    public function payment($usingService, $useData, $id)
    {
        $usingService = UsingService::find($usingService);
        $useData = UseData::find($useData);
        $bill = Bill::find($id);
        if($usingService != null && $useData != null && $bill != null){
            return view('manager.bill.payment')->with(['usingService' => $usingService, 'useData' => $useData, 'bill' => $bill]);
        }else{
            return back()->with('failures', ['Invailid using service ID or use data ID']);
        }
    }
}
