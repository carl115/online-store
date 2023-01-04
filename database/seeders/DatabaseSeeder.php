<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeed;
use Database\Seeders\CategorySeed;
use Database\Seeders\RoleSeeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeed::class,
            CategorySeed::class
        ]);

        Product::factory(20)->create();
    }
}
