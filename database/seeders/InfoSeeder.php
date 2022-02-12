<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('info')->insert([
                [
                    'facebook' => 'lapidare',
                    'instagram' => 'lapidare ',
                    'email1' => 'contato@lapidare.com.br',
                    'cellphone1' => '66996102002',
                    'address' => 'Rua Acyr Rezende de Souza e Silva, 1852 - Vila Birigui, Rondonópolis - MT, CEP 78705-025',
                    'institutional_text' => 'Estética Avançada - Depilação a Laser - InFORMA Emagrecimento - ImunoFORCE',
                    'user_id' => 1
                ]
            ]);
    }
}
