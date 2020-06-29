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
                'name'      => 'Carlos Enrique Hoy Chi',
                'email'     => 'cenriquene@gmail.com',
                'password'  => bcrypt('password'),
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
