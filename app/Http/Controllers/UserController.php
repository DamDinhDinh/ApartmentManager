<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'ASC')->paginate(10);
        return view('manager.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->phone_number = $request->phoneNumber;
        $user->email = $request->email;
        $user->type = $request->type;
        
        $user->password =  Hash::make($request->password);
        // 
        if($user->save()){
            return redirect()->route('user.show', $user->id)->with('messages', ['CREATED user: '.$user->name." phone number: ".$user->phone_number]); 
        }else{
            return redirect()->route('user.index')->with('failures', ['Can not excute!']);
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
        $user = User::find($id);

        return view('manager.user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('manager.user.edit')->with('user', $user);
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->phone_number = $request->phoneNumber;
        $user->email = $request->email;
        $user->type = $request->type;
        
        $user->password =  Hash::make($request->password);
        // 
        if($user->save()){
            return redirect()->route('user.show', $user->id)->with('messages', ['UPDATED user: '.$user->name." phone number: ".$user->phone_number]); 
        }else{
            return redirect()->route('user.index')->with('failures', ['Can not excute!']);
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
        $user = User::find($id);

        if($user != null){
            if($user->delete()){
                return redirect()->route('user.index')->with('messages', ['DELETED user: '.$user->name." address ".$user->phone_number]);
            }else{
                return redirect()->route('user.index')->with('failures', ['Can not excute!']);
            }
        }else{
            return redirect()->route('user.index')->with('failures', ['Invailid user ID']);
        }
    }
}
