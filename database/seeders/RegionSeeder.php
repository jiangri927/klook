<?php

namespace Database\Seeders;

use App\Models\MainDestination;
use App\Models\Region;
use App\Models\SubDestination;
use App\Models\WelcomeGallery;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Region::factory(5)->create()->each(function ($region){
            MainDestination::factory(5)->create([
                'region_id' => $region->id,
            ])->each(function ($m_dest){
                SubDestination::factory(5)->create([
                    'region_id'=> $m_dest->region_id,
                    'main_destination_id' => $m_dest->id,
                ])->each(function ($s_dest){
//                    WelcomeGallery::factory(1)->create([
//                        'kind' => 's_dest',
//                        'kind_id' => $s_dest->id,
//                        'index' => 1,
//                    ]);
                });
            });
        });
    }
}
