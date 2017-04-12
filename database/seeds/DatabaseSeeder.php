<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds to build sample data.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SizesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PapersTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
//        DB::table('users')->insert([
//            'name' => 'Chris Connor',
//            'email' => 'chris@connor.com',
//            'password' => bcrypt('comcom'),
//        ]);
    }
}
