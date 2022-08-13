<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('roles')->insert([
            [
                'id' => '1',
                'role' => 'admin',
            ],
            [
                'id' => '2',
                'role' => 'penjual',
            ],
            [
                'id' => '3',
                'role' => 'pelanggan',
            ],
        ]);
    }
}
