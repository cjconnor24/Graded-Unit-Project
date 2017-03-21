<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(array(
            array('name'=>'Business Cards','created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'Posters','created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'Booklets','created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'Leaflets','created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47')
        ));
    }
}
