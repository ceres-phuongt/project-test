<?php
namespace Database\Seeders;

use Backend\Car\Models\EngineSize;
use Backend\Car\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        Tag::truncate();
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
