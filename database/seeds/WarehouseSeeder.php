<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str as Str;
use Carbon\Carbon;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name'          => '4k Monitors',
                'description'   => 'Monitors with ultra clear 4K UHD (3840x2160) resolution.',
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'Gaming Monitors',
                'description'   => 'Exceptional gaming experience at more than 60Hz refresh.',
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'All purposes Monitors',
                'description'   => 'The best monitors for for all purposes.',
                'created_at'    => Carbon::now()
            ],
        ]);

        DB::table('products')->insert([
            [
                'name'          => 'LG 27UK850-W 27',
                'slug'          => Str::slug('LG 27UK850-W 27'),
                'description'   => 'LG 27UK850-W 27" 4K UHD IPS Monitor with HDR10 with USB Type-C Connectivity and FreeSync, White',
                'price'         => 499.99,
                'category_id'   => 1,
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'Dell Ultrasharp U2718Q',
                'slug'          => Str::slug('Dell Ultrasharp U2718Q'),
                'description'   => 'Exceptional details, ultimate efficiency — a 27” 4K screen with incredibly thin bezels — ideal for multiple monitor setup',
                'price'         => 434.62,
                'category_id'   => 1,
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'Samsung 32 inch UJ59',
                'slug'          => Str::slug('Samsung 32 inch UJ59'),
                'description'   => 'Samsung 32 inch UJ59 4k monitor (LU32J590UQNXZA) - UHD, 3840 x 2160p, 60hz, 4ms, Dual monitor, laptop monitor, monitor stand / riser / mount compliant, AMD FreeSync, Gaming, HDMI, DP, Black',
                'price'         => 359.99,
                'category_id'   => 1,
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'LG 27GL83A-B 27',
                'slug'          => Str::slug('LG 27GL83A-B 27'),
                'description'   => 'LG 27GL83A-B 27 Inch Ultragear QHD IPS 1ms NVIDIA G-SYNC Compatible Gaming Monitor, Black',
                'price'         => 379.99,
                'category_id'   => 2,
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'AOC C24G1 24',
                'slug'          => Str::slug('AOC C24G1 24'),
                'description'   => 'AOC C24G1 24" Curved Frameless Gaming Monitor, FHD 1080p, 1500R VA panel, 1ms 144Hz, FreeSync, Height adjustable, VESA, 3-Year Zero Dead Pixels',
                'price'         => 144.99,
                'category_id'   => 2,
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'Asus Rog Swift PG35VQ',
                'slug'          => Str::slug('Asus Rog Swift PG35VQ'),
                'description'   => 'Asus Rog Swift PG35VQ 35” Curved HDR Gaming Monitor 200Hz (3440 X 1440) 2ms G-Sync Ultimate Eye Care DisplayPort HDMI USB Aura Sync HDR10 Display HDR 1000',
                'price'         => 2299.99,
                'category_id'   => 2,
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'HP VH240a',
                'slug'          => Str::slug('HP VH240a'),
                'description'   => 'HP VH240a 23.8-inch Full HD 1080p IPS LED Monitor with Built-in Speakers and VESA Mounting, Rotating Portrait & Landscape, Tilt, and HDMI & VGA Ports (1KL30AA) - Black',
                'price'         => 198.13,
                'category_id'   => 3,
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'BenQ GW2480',
                'slug'          => Str::slug('BenQ GW2480'),
                'description'   => 'BenQ 24 Inch IPS Monitor | 1080P | Proprietary Eye-Care Tech | Ultra-Slim Bezel | Adaptive Brightness for Image Quality | Speakers | GW2480',
                'price'         => 120.99,
                'category_id'   => 3,
                'created_at'    => Carbon::now()
            ],
            [
                'name'          => 'Samsung LS24R350FHNXZA',
                'slug'          => Str::slug('Samsung LS24R350FHNXZA'),
                'description'   => 'Samsung 24" FHD Monitor with Bezel-LESS Design - LS24R350FHNXZA, Dark Blue Gray',
                'price'         => 158.98,
                'category_id'   => 3,
                'created_at'    => Carbon::now()
            ]
        ]);
    }
}
