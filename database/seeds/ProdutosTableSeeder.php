<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            DB::table('produtos')->insert([
                'nome' => $faker->name,
                'preco' => $faker->numerify('###'),
                'descricao' => $faker->text,
            ]);
        }
    }
}
