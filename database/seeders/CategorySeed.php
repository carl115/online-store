<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeed extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert(['name' => 'Beauty']);
        DB::table('categories')->insert(
            ['name' => 'Electrical appliance']
        );
        DB::table('categories')->insert(['name' => 'Technology']);
        DB::table('categories')->insert(['name' => 'Home']);
    }
}
