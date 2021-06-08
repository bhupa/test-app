<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $role = ['admin','user'];
        for($i = 0; $i < 15; $i++) {
            $data [] =[
                'user_name'=>$faker->name,
                'email'=>$faker->email,
                'user_role'=>$faker->randomElement( $role),
                'password'=>bcrypt('password'),
                'registered_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()

            ];
        }
        DB::table('users')->insert($data);

    }
}
