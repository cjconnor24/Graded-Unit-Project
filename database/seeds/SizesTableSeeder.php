<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds for the Size table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert(array(
            array('name'=>'A0','height'=>840,'width'=>1188,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A1','height'=>594,'width'=>840,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A2','height'=>420,'width'=>594,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A3','height'=>297,'width'=>420,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A4','height'=>210,'width'=>297,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A5','height'=>148,'width'=>210,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A6','height'=>105,'width'=>148,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'A7','height'=>74,'width'=>105,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'Business Card (85 x 55)','height'=>55,'width'=>85,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47'),
            array('name'=>'Business Card (90 x 55)','height'=>55,'width'=>90,'created_at'=>'2017-03-21 07:41:47','updated_at'=>'2017-03-21 07:41:47')
        ));
    }
}
