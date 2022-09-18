<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);

route::group(["prefix" => "","middleware" => "auth:sanctum","controller" => ChatController::class],function (){

    Route::get('User/{id}/Messages','MessagesForUser');
    Route::get('User/{id}/Room','UserForRoom');
    Route::get('user/{id}','User');
    Route::get('Room/{id}/Messages','MessagesForRoom');
    Route::get('User/Rooms','RoomForUser');
    Route::post('Room/{id}/StoreMessage','StoreMessage');
    Route::put('user/{id}/offline','offline');
    Route::put('user/{id}/online','online');
    Route::get('User/ExceptMe','UserExceptMe');
    Route::get('User/{id}/SendFriendShip','SendFriendShip');
    Route::get('user/{id}/{status}/ProcessFriendShip','ProcessFriendShip');
    Route::get('User/GetFriendShip','GetFriendShip');


});

Route::get("logout", [AuthController::class, "logout"])->middleware('auth:sanctum');
route::post('login',[AuthController::class, "login"]);
Route::put('user/{id}/offline', [AuthController::class, "offline"])->middleware('auth:sanctum');
Route::put('user/{id}/online', [AuthController::class, "online"])->middleware('auth:sanctum');

Route::post("register", [AuthController::class, "register"]);
