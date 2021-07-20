<?php

namespace Database\Seeders;

use App\Models\PackageTicket;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductPackage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::factory(50)->create()->each(function ($product){
            ProductPackage::factory(3)->create([
                'product_id' => $product->id,
            ])->each(function ($package){
                PackageTicket::factory(3)->create([
                    'package_id' => $package->id,

                ]);
            });
            ProductGallery::factory(9)->create([
                'product_id' => $product->id,
            ]);
        });
    }
}
