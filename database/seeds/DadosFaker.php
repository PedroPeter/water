<?php

use Illuminate\Database\Seeder;

class DadosFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker ::create ("App\");
    }
}
