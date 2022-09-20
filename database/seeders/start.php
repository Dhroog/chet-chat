<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\room_user;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class start extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $yousef = new User();
        $yousef->name = 'chet-chat';
        $yousef->email = 'chet-chat@gmail.com';
        $yousef->password = Hash::make(1);
        $yousef->image = 'luffy.png';
        $yousef->save();

        $yousef = new User();
        $yousef->name = 'يوسف';
        $yousef->email = 'yousef@gmail.com';
        $yousef->password = Hash::make(1);
        $yousef->image = 'luffy.png';
        $yousef->save();

        $saed = new User();
        $saed->name = 'سعيد';
        $saed->email = 'saed@gmail.com';
        $saed->password = Hash::make(1);
        $saed->image = 'avatar.jpg';
        $saed->save();

        $firase = new User();
        $firase->name = 'فراس';
        $firase->email = 'firase@gmail.com';
        $firase->password = Hash::make(1);
        $firase->image = 'avatar.jpg';
        $firase->save();

        $yousef->fr()->create([
            'friend_id' => $saed->id
        ]);

        $yousef->fr()->create([
            'friend_id' => $firase->id
        ]);

        $saed->fr()->create([
            'friend_id' => $firase->id
        ]);

        $saed->fr()->create([
            'friend_id' => $yousef->id
        ]);

        $firase->fr()->create([
            'friend_id' => $yousef->id
        ]);

        $firase->fr()->create([
            'friend_id' => $saed->id
        ]);



        $room1 = new Room();
        $room1->save();
        $room2 = new Room();
        $room2->save();
        $room3 = new Room();
        $room3->save();

        $room_user = new room_user();
        $room_user->user_id = $yousef->id;
        $room_user->room_id = $room1->id;
        $room_user->save();

        $room_user = new room_user();
        $room_user->user_id = $saed->id;
        $room_user->room_id = $room1->id;
        $room_user->save();

        $room_user = new room_user();
        $room_user->user_id = $yousef->id;
        $room_user->room_id = $room2->id;
        $room_user->save();

        $room_user = new room_user();
        $room_user->user_id = $firase->id;
        $room_user->room_id = $room2->id;
        $room_user->save();

        $room_user = new room_user();
        $room_user->user_id = $saed->id;
        $room_user->room_id = $room3->id;
        $room_user->save();

        $room_user = new room_user();
        $room_user->user_id = $firase->id;
        $room_user->room_id = $room3->id;
        $room_user->save();

        User::factory()->count(10)
            ->create();

    }
}
