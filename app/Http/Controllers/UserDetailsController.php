<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $blood_group = $request['blood_group'] ?? "";
       
       if(auth()->user()->isUser == '0')
       {
            if($blood_group != ""){
                $users = User::where([
                    ['isUser','1'],
                    ['blood_group', $blood_group]
                ])->get();
                $request->session()->flash('blood_group',$blood_group);
                return view('user.home',compact('users'));
            }
            else{
               
                $users = User::where('isUser','1')->get();
                return view('user.home',compact('users'));
            }
            

       }
       else{
            $notification_pending = Notification::where([
                ['user_id',auth()->user()->id],
                ['isPending','0']
            ])->count();
           $offers = Offer::all();
           $book = Book::where('user_id',auth()->user()->id)->get();
           $notification_count = Notification::where([
               ['isPending',1],
               ['user_id',auth()->user()->id]
           ])->count();
           $amt = $notification_count * 5;
           return view('user.home',compact('amt','offers','book','notification_pending'));
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
        $notification_pending = Notification::where([
            ['user_id',auth()->user()->id],
            ['isPending','0']
        ])->count();
        $user = User::find($id);
        return view('user.details',compact('user','notification_pending'));
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
        $request->validate([
            'phone'=>'min:10'
        ]);
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
        $request->session()->flash('message','Record Updated');
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
    public function send_notification($id, Request $request){
        $notification = new Notification();
        $notification->user_id = $id;
        $notification->hospital_id = auth()->user()->id;
        $notification->message = "Need Urgent Blood";
        $notification->save();
        $user = User::find($id);
        $hospital = User::find(auth()->user()->id);
        Nexmo::message()->send([
            'to'   => '977'.$user->phone,
            'from' => '9779842064331',
            'text' => 'Emergency!!! You need to donate your blood at '.$hospital->name.' located at '.$hospital->address.'. Please confirm your link http://127.0.0.1:8000/show_notification'
        ]);
        $request->session()->flash('message','Message Sent');
        return redirect()->back();
    }
    public function show_notification()
    {
        $notification_pending = Notification::where([
            ['user_id',auth()->user()->id],
            ['isPending','0']
        ])->count();
        $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('id','DESC')->get();
        return view('user.show_notification', compact('notifications','notification_pending'));
    }
    public function reset_pending($id){
        $notification = Notification::find($id);
        $notification->isPending = 1;
        $notification->update();
        return redirect()->back();
    }
    public function book($id)
    {
        $book = new Book();
        $book->user_id = auth()->user()->id;
        $book->offer_id = $id;
        $book->save();

        return redirect()->back();
    }
   
}
