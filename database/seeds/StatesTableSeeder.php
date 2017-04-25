<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert(array(
            array('name'=>'quote','created_at'=>'2017-03-21 09:43:18','updated_at'=>'2017-03-21 09:43:18'),
            array('name'=>'order','created_at'=>'2017-03-21 09:43:18','updated_at'=>'2017-03-21 09:43:18'),
            array('name'=>'invoice','created_at'=>'2017-03-21 09:43:18','updated_at'=>'2017-03-21 09:43:18'),

        ));

    }
}
