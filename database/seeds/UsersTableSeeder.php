<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ganjar Setia',
            'email' => 'admin@aaganjar.com',
            'password' => bcrypt('admin'),
            'role' => 'gudang',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Petugas Kurir 1',
            'email' => 'kurir@aaganjar.com',
            'password' => bcrypt('kurir'),
            'role' => 'kurir',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
