<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EngineSizeTableSeeder extends Seeder
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

        $arrray = ['250cc', '300cc', '500cc', '750cc', '1000cc', '1250cc', '1500cc', '2000cc', '2500cc', '4200cc', '8000cc'];

        foreach ($arrray as $item) {
            DB::table('engine_sizes')->insert([
                'name'   => $item,
                'status' => 'published'
            ]);
        }
    }
}
