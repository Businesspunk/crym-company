<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Profile;

class userSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make("123456789");
        
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@crym.com',
            'password' => $password,
        ]);

        Profile::create([
            'user_id' => $user->id
        ]);
    }
}
