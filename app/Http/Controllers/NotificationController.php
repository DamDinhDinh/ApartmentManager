<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Notification;

class NotificationController extends Controller
{
    function __construct(){
        $this->middleware('manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'ASC')->paginate(10);

        return view('manager.notification.index')->with('notifications',$notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.notification.create');
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
            'title' => 'required',
            'body' => 'required'
        ]);

        $user = Auth::user();

        $notification = new Notification();

        $notification->title = $request->title;
        $notification->body = $request->body;
        $notification->user_id = $user->id;

        if($notification->save()){
            return redirect()->route('notification.show', $notification->id)->with('messages', [trans('messages.create_success')]);
        }else{
            return redirect()->back()->with('messages', [trans('messages.cant_excute')]);
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
        $notification = Notification::find($id);

        if($notification != null){
            return view('manager.notification.show')->with('notification', $notification);
        }else{
            return redirect()->back()->with('message', [trans('messages.not_exist')]);
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

        $notification = Notification::find($id);

        if($notification != null){
            return view('manager.notification.edit')->with('notification', $notification);
        }else{
            return redirect()->back()->with('message', [trans('messages.not_exist')]);
        }
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
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $notification = Notification::find($id);
        if($notification != null){
            $notification->title = $request->title;
            $notification->body = $request->body;

            if($notification->save()){
                return redirect()->route('notification.show', $notification->id)->with('messages', [trans('messages.update_success')]);
            }else{
                return redirect()->back()->with('messages', [trans('messages.cant_excute')]);
            }
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
        $notification = Notification::find($id);

        if($notification != null){
            if($notification->delete()){
                return redirect()->route('notification.index')->with('messages', [trans('messages.delete_success')]);
            }else{
                return redirect()->route('notification.index')->with('failures', [trans('messages.cant_excute')]);
            }
        }else{
            return redirect()->route('notification.index')->with('failures', [trans('messages.not_exist')]);
        }
    }
}
