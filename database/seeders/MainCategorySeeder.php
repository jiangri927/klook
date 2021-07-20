<?php

namespace Database\Seeders;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class MainCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MainCategory::factory(5)->create()->each(function ($main_category){
            SubCategory::factory(5)->create([
                'parent_id' => $main_category->id,
            ]);
        });
    }
}
