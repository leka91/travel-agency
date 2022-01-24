<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'name'       => 'Belgrade tour',
                'slug'       => Str::slug('Belgrade tour'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'       => 'Hiking tour',
                'slug'       => Str::slug('Hiking tour'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'       => 'Wine tour',
                'slug'       => Str::slug('Wine tour'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'       => 'One day tour',
                'slug'       => Str::slug('One day tour'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'       => 'Multi day tour',
                'slug'       => Str::slug('Multi day tour'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
