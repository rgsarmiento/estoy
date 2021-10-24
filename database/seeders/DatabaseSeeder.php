<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name'  => 'Jhon Smith',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('89112652044Rg$'),
        ]);
    }
}
