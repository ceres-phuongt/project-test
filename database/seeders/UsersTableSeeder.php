<?php
namespace Database\Seeders;

use Backend\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // \Backend\User\Models\User::factory(10)->create();
        DB::table('users')->insert([
                'name'              => 'Admin',
                'email'             => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'user_type'         => 'admin',
                'remember_token'    => Str::random(10),
            ]);

        DB::table('users')->insert([
                'name'              => 'Member',
                'email'             => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'user_type'         => 'admin',
                'remember_token'    => Str::random(10),
            ]);

        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name'              => $faker->name(),
                'email'             => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'user_type'         => $faker->randomElement(['admin', 'member']),
                'remember_token'    => Str::random(10),
            ]);
        }
    }
}
