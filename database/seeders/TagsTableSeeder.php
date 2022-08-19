<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        EngineSize::truncate();
        Schema::enableForeignKeyConstraints();

        $arrray = ['2 doors', '4 doors' , 'Red', 'Yellow', 'Black', 'White'];

        foreach ($arrray as $item) {
            DB::table('tags')->insert([
                'name'   => $item,
                'status' => 'published'
            ]);
        }
    }
}
