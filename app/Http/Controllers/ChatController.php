<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\Friend;
use App\Models\Message;
use App\Models\Room;
use App\Models\room_user;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    use GeneralTrait;

    public function  RoomForUser(): JsonResponse
    {

        return $this->returnData('Success',auth()->user()->rooms);
    }

    public function  MessagesForUser(): JsonResponse
    {
        return $this->returnData('Success',auth()->user()->messages);
    }

    public function  MessagesForRoom($id ): JsonResponse
    {
        $room = Message::where('room_id',$id)->with('user')->orderBy('created_at','DESC')->get();
        return $this->returnData('Success',$room);
    }

    public function StoreMessage(Request $request,$RoomID): Message
    {
        $message = new Message();
        $message->user_id = Auth::id();
        $message->room_id = $RoomID;
        $message->message = $request->message;
        $message->save();

        broadcast(new SendMessage($message))->toOthers();
        return $message;
    }

    public function UserForRoom($id)
    {
        $user = Room::find($id)->users;
        return $this->returnData('Success',$user);
    }

    public function UserExceptMe(){
        $user = User::where('id','!=',auth::id())->get();
        return $this->returnData('Success',$user);

    }

    public function SendFriendShip($id){
        $freind = User::find($id)->friends()->create([
            'friend_id' => auth::id(),
        ]);

        return $this->returnSuccessMessage();
    }

    public function ProcessFriendShip($id,$status){
        if($status){
            $friend = Friend::find($id);
            $friend->accept = true;
            $friend->seen = true;
            $friend->save();

            $room = new Room();
            $room->save();

            $room->users()->attach([
                $friend->user_id,
                $friend->friend_id
            ]);
        }else {
            $friend = Friend::find($id);
            $friend->accept = false;
            $friend->seen = true;
            $friend->save();
        }

    }
    public function GetFriendShip()
    {
        $friends = Friend::where([
            ['user_id','=',auth::id()],
            ['seen','=',false]
        ])->get();
        return $this->returnData('success',$friends);
    }
    public function User($id){
        return $this->returnData('success',User::find($id));
    }


}
