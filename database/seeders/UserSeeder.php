<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Courage Kwashiga',
            'email' => 'courage@gmail.com',
            'password' => Hash::make('password12'), // password
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole('admin');

        Profile::create([
            'user_id' => $admin->id,
            'first_name' => 'Courage',
            'last_name' => 'Kwashiga',
            'phone' => null,
            'address' => null,
        ]);
    }
}
