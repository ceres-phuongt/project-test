<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MakesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrray = ['Toyota', 'Honda', 'BMW', 'Volkswagen', 'Daimler', 'Ford', 'Tesla', 'Ferrari',
                'Ferrari', 'Lamborghini', 'Bentley', 'Audi', 'Jeep', 'Subaru', 'Hyundai', 'Jaguar', 'Mazda'];
        $faker = Faker\Factory::create();

        foreach ($arrray as $item) {
            DB::table('makes')->insert([
                'name'        => $item,
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => 'published'
            ]);
        }
    }
}
