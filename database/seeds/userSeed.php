<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;
use App\Models\Profile;
use App\Models\RoleUser;

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

        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'moderator'
        ]);
        Role::create([
            'name' => 'vip'
        ]);
        RoleUser::create([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }
}
