<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShopConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'          => 'Carlos Enrique Hoy Chi',
                'first_name'    => 'Carlos Enrique',
                'last_name'     => 'Hoy Chi',
                'email'         => 'cenriquene@gmail.com',
                'password'      => bcrypt('password'),
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'System administrator',
                'first_name'    => 'Root',
                'last_name'     => 'Administrator',
                'email'         => 'system@gmail.com',
                'password'      => bcrypt('password'),
                'created_at'    => Carbon::now()
            ]
        ]);
    }
}
