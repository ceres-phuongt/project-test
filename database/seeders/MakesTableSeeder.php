<?php
namespace Database\Seeders;

use Backend\Car\Models\Make;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Make::truncate();
        Schema::enableForeignKeyConstraints();

        $arrray = ['Toyota', 'Honda', 'BMW', 'Volkswagen', 'Daimler', 'Ford', 'Tesla', 'Ferrari',
                'Ferrari', 'Lamborghini', 'Bentley', 'Audi', 'Jeep', 'Subaru', 'Hyundai', 'Jaguar', 'Mazda'];

        $faker = \Faker\Factory::create();

        foreach ($arrray as $item) {
            DB::table('makes')->insert([
                'name'        => $item,
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => 'published'
            ]);
        }
    }
}
