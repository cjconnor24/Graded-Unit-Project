<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            array('slug'=>'admin','name'=>'Administrators','created_at'=>\Carbon\Carbon::now()),
            array('slug'=>'accounts','name'=>'Accounts','created_at'=>\Carbon\Carbon::now()),
            array('slug'=>'customer','name'=>'Customers','created_at'=>\Carbon\Carbon::now()),
            array('slug'=>'staff','name'=>'Staff','created_at'=>\Carbon\Carbon::now())
        ));

    }
}
