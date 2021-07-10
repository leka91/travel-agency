<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Belgrade tour',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hiking tour',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Wine tour',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'One day tour',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Multi day tour',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
