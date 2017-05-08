<?php

use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert(array(
            array('name'=>'Awaiting Payment','created_at'=>\Carbon\Carbon::now()),
            array('name'=>'With Artworker','created_at'=>\Carbon\Carbon::now()),
            array('name'=>'Awaiting Proof Approval','created_at'=>\Carbon\Carbon::now()),
            array('name'=>'Production','created_at'=>\Carbon\Carbon::now()),
            array('name'=>'Finishing','created_at'=>\Carbon\Carbon::now()),
            array('name'=>'Distribution','created_at'=>\Carbon\Carbon::now()),
            array('name'=>'Completed','created_at'=>\Carbon\Carbon::now())
        ));
    }
}
