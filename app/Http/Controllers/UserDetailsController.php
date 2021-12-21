<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(auth()->user()->isUser == '0')
       {
            $users = User::where('isUser','1')->get();
            return view('user.home',compact('users'));

       }
       else{
           $notification_count = Notification::where([
               ['isPending',1],
               ['user_id',auth()->user()->id]
           ])->count();
           return view('user.home',compact('notification_count'));
       }
        // return view('user.details');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('user.details');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $user = User::find($id);
        return view('user.details',compact('user'));
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
        $user = User::find($id);
        // return $request;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if(isset($request->blood_group)){
            $user->blood_group = $request->blood_group;
        }
        if(isset($request->pan)){
            $user->pan = $request->pan;
        }
        if(isset($request->lat)){
            $user->lat = $request->lat;
        }
        if(isset($request->lon)){
            $user->lon = $request->lon;
        }
        $user->update();
        return redirect()->back();
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
    public function userJson(){
        $users = User::where('isUser','1')->get();
        $user_json = json_encode($users);
        return $user_json;
    }
    public function show_map(){
        return view('user.user_map');
    }
    public function send_notification($id){
        $notification = new Notification();
        $notification->user_id = $id;
        $notification->hospital_id = auth()->user()->id;
        $notification->message = "Need Urgent Blood";
        $notification->save();
        return 'Success';
    }
    public function show_notification()
    {
        $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('id','DESC')->get();
        return view('user.show_notification', compact('notifications'));
    }
    public function reset_pending($id){
        $notification = Notification::find($id);
        $notification->isPending = 1;
        $notification->update();
        return redirect()->back();
    }
}
