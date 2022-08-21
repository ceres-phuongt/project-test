<?php
namespace Database\Seeders;

use Backend\Car\Models\Car;
use Backend\Car\Models\CarTag;
use Backend\Car\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CarTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        CarTag::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < 30; $i++) {
            DB::table('car_tags')->insert([
                'car_id' => Car::all()->random()->id,
                'tag_id' => Tag::all()->random()->id,
            ]);
        }
    }
}
