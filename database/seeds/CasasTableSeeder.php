<?php

use Illuminate\Database\Seeder;

class CasasTableSeeder extends Seeder
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
            DB::table('casas')->insert([
                'nome' => $faker->name,
                'apelido' => $faker->name,
                'celular1' => $faker->phoneNumber,
                'celular2' => $faker->phoneNumber,
                'email' => $faker->email,
                'username' => $faker->userName,
                'cargo' => 'User',
                'password' => bcrypt('secret'),
            ]);
        }
    }
}
