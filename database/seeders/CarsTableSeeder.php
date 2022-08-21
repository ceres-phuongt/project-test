<?php
namespace Database\Seeders;

use Backend\Car\Models\EngineSize;
use Backend\Car\Models\Make;
use Backend\Car\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CarsTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Car::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('cars')->insert([
              'name'           => $faker->sentence(8, true) . ' - ' . Make::all()->random()->id . ' - ' . $faker->unique()->ean8,
              'model'          => $faker->unique()->ean8,
              'make_id'        => Make::all()->random()->id,
              'engine_size_id' => EngineSize::all()->random()->id,
              'registration'   => $faker->text(512),
              'price'          => $faker->randomFloat(null, 0, null),
              'status'         => 'published'
            ]);
        }
    }
}
