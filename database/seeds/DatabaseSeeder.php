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
        $this->call(RolesSeeder::class);
//        factory(App\User::class, 100)->create();
//        factory(App\Address::class)->create();

        factory(App\User::class, 10)
            ->create()
            ->each(function($u) {

                // CREATE SENTINEL ACTIVATIONS
                $activation = \Cartalyst\Sentinel\Laravel\Facades\Activation::create($u);
                \Cartalyst\Sentinel\Laravel\Facades\Activation::complete($u,$activation->code);

                $u->addresses()->save(factory(App\Address::class)->make());
                $u->addresses()->save(factory(App\Address::class)->make());
                $u->addresses()->save(factory(App\Address::class)->make());
            });

        // $this->call(UsersTableSeeder::class);
//        DB::table('users')->insert([
//            'name' => 'Chris Connor',
//            'email' => 'chris@connor.com',
//            'password' => bcrypt('comcom'),
//        ]);
    }
}
