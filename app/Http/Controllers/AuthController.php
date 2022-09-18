<?php

namespace App\Http\Controllers;

use App\Events\UserOffline;
use App\Events\UserOnline;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use GeneralTrait;
    public function register(Request $request)
    {
        // validation
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required",
            //'image'   => ['image', 'dimensions:max_width=1000,max_height=1000'],
        ]);

/*
        $file = $request->file('image');
        $name = '/avatars/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public/Images', $name);
*/


        // create data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // send response
        return  $this->returnSuccessMessage();
    }

    public function login(Request $request)
    {
        // validation
        $request->validate([

            "email" => "required",
            "password" => "required",
        ]);

        // check user
        $user = User::where("email", "=", $request->email)->first();
        if (isset($user->id)) {

            if (Hash::check($request->password, $user->password)) {
                // create a token
                $token = $user->createToken("auth_token")->plainTextToken;
                $data = [
                    'id' => $user->id,
                    'token' => $token
                ];
                return  $this->returnData('logged in successfully', $data);
            } else {
                return $this->returnError( "Password incorrect");
            }
        } else {
            return $this->returnError( "email incorrect");
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return redirect()->route('login');
    }

    public function offline($id)
    {
        $user = User::find($id);
        $user->status = false;
        $user->save();

        broadcast(new UserOffline($user));
    }

    public function online($id)
    {
        $user = User::find($id);
        $user->status = true;
        $user->save();

        broadcast(new UserOnline($user));
    }
}
