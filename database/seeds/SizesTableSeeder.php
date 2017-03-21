<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert(array(
            array('name'=>'A0','height'=>840,'width'=>1188,'created_at'=>'2017-03-21 07:41:47','modified_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A1','height'=>594,'width'=>840,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A2','height'=>420,'width'=>594,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A3','height'=>297,'width'=>420,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A4','height'=>210,'width'=>297,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A5','height'=>148.5,'width'=>210,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A6','height'=>105,'width'=>148.5,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A7','height'=>74.25,'width'=>105,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47')
        ));
    }
}
