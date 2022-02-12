<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use DB;

class PetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('pet_categories')->insert([
				[
                    'name' => 'Gato',
                    'slug' => Str::slug('Gato', '-'),
                    'user_id' => '1'
                ],
                [
                    'name' => 'Cachorro',
                    'slug' => Str::slug('Cachorro', '-'),
                    'user_id' => '1'
                ]
			]);
    }
}
