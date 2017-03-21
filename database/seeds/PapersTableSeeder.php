<?php

use Illuminate\Database\Seeder;

class PapersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('papers')->insert(array(
            array('name'=>'350gsm Uncoated','manufacturer'=>'Xerox','weight'=>350,'created_at'=>'2017-03-21 09:43:18','updated_at'=>'2017-03-21 09:43:18'),
            array('name'=>'350gsm Gloss','manufacturer'=>'Xerox','weight'=>350,'created_at'=>'2017-03-21 09:43:18','updated_at'=>'2017-03-21 09:43:18'),
            array('name'=>'210gsm Silk','manufacturer'=>'Xerox','weight'=>210,'created_at'=>'2017-03-21 09:43:18','updated_at'=>'2017-03-21 09:43:18'),
            array('name'=>'90gsm Copy Paper','manufacturer'=>'Xerox','weight'=>90,'created_at'=>'2017-03-21 09:43:18','updated_at'=>'2017-03-21 09:43:18'),
            array('name'=>'210gsm Uncoated','manufacturer'=>'Xerox','weight'=>210,'created_at'=>'2017-03-21 09:43:18','updated_at'=>'2017-03-21 09:43:18')
        ));

    }
}
