<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
				DB::table('tb_user')->insert([
					'nama' => 'Super Admin',
					'username' => 'admin',
					'password' => bcrypt('admin'),
					'role' => 'admin'
				]);

        DB::table('tb_user')->insert([
            'nama' => 'Fauzi',
            'username' => 'owner',
            'password' => bcrypt('owner'),
            'role' => 'owner'
        ]);

        DB::table('tb_user')->insert([
            'nama' => 'Rahman',
            'username' => 'kasir',
            'password' => bcrypt('kasir'),
            'role' => 'kasir'
        ]);
    }
}
