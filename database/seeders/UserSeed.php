<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeed extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Carlos Diaz',
            'email' => 'dcarlos@gmail.com',
            'password' => 123456789
        ])->assignRole('Admin');

        User::factory(10)->create();
    }
}
