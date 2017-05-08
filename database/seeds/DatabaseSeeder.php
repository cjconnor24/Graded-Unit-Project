<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seed with sample data for application.
     *
     * @return void
     */
    public function run()
    {

        $this->call(SizesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PapersTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(OrderStatusesSeeder::class);
//        factory(App\User::class, 100)->create();

        // USER SEEDER FACTORY
        factory(App\User::class, 10)
            ->create()
            ->each(function($u) {

                // CREATE SENTINEL ACTIVATIONS
                $activation = \Cartalyst\Sentinel\Laravel\Facades\Activation::create($u);
                \Cartalyst\Sentinel\Laravel\Facades\Activation::complete($u,$activation->code);

                // ATTACH USER TO ROLE
                $role = Sentinel::findRoleBySlug('customer');
                $role->users()->attach($u);

                // GIVE USER n Addresses
                $numberOfAddresses = 2;

                for($i = 1; $i<=$numberOfAddresses; $i++){
                    $u->addresses()->save(factory(App\Address::class)->make());
                }

            });

        factory(App\Branch::class, 6)->create();

        factory(App\User::class, 1)
            ->create()
            ->each(function($u) {

                // CREATE SENTINEL ACTIVATIONS
                $activation = \Cartalyst\Sentinel\Laravel\Facades\Activation::create($u);
                \Cartalyst\Sentinel\Laravel\Facades\Activation::complete($u,$activation->code);

                // ATTACH USER TO ROLE
                $role = Sentinel::findRoleBySlug('admin');
                $role->users()->attach($u);

            });

    }
}
