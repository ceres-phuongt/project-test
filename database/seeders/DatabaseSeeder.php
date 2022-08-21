<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 /**
  * Seed the application's database.
  *
  * @return void
  */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MakesTableSeeder::class);
        $this->call(EngineSizeTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(CarsTableSeeder::class);
        $this->call(CarTagsTableSeeder::class);
    }
}
