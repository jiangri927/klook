<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WelcomeGallery;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory(5)->create();
//        WelcomeGallery::factory(10)->create();
        User::factory(1)->create([
            'email' => 'admin@admin.com',
            'user_role'=>1
        ]);
    }
}
