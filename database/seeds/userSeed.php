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
        $password2 = Hash::make("987654321");
        
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@crym.com',
            'password' => $password,
        ]);

        $user2 = User::create([
            'name' => 'vip',
            'email' => 'vip@crym.com',
            'password' => $password2,
        ]);

        Profile::create([
            'user_id' => $user->id
        ]);

        Profile::create([
            'user_id' => $user2->id
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
            'user_id' => $user->id,
            'role_id' => 1
        ]);
        RoleUser::create([
            'user_id' => $user2->id,
            'role_id' => 3
        ]);
    }
}
