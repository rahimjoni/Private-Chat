<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userlist(){
        $users = User::latest()->where('id','!=',auth()->user()->id)->get();

        if(\Request::ajax()){
            return response()->json($users,200);
        }

        return abort(404);

    }
    public function usermessage($id=null){

        $user = User::findOrFail($id);
        $message = $this->message_by_user($id);

        return response()->json([
            'message' => $message,
            'user' => $user,
        ]);
    }
    public function sendmessage(Request $request){

      $messages = Message::create([
          'message' => $request->message,
          'from' => auth()->user()->id,
          'to' => $request->user_id,
          'type' => 0,
      ]);
        $messages=Message::create([
            'message' => $request->message,
            'from' => auth()->user()->id,
            'to' => $request->user_id,
            'type' =>1,
        ]);
      return response()->json($messages,201);
    }
    public function deletesinglemessage($id=null){

        Message::findOrFail($id)->delete();
        return response()->json('deleted',200);

    }
    public function deleteallmessage($id=null){

        $message= $this->message_by_user($id);
        foreach ($message as $value){
            Message::findOrFail($value->id)->delete();
        }
        return response('deleted',200);
    }
    public function message_by_user($id){

        $message = Message::where(function($q) use($id){
            $q->where('from',auth()->user()->id);
            $q->where('to',$id);
            $q->where('type',0);

        })->orWhere(function($q) use($id){
            $q->where('from',$id);
            $q->where('to',auth()->user()->id);
            $q->where('type',1);
        })->with('user')->get();
        return $message;
    }
}
