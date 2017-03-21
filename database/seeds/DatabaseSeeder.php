<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(SizesTableSeeder::class);
//        DB::table('sizes')->insert([
//            'name' => 'A4',
//            'width' => 210,
//            'height' => 297,
//        ]);
        // $this->call(UsersTableSeeder::class);
//        DB::table('users')->insert([
//            'name' => str_random(10),
//            'email' => str_random(10).'@gmail.com',
//            'password' => bcrypt('secret'),
//        ]);
    }
}
