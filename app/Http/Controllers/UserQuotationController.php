<?php

namespace App\Http\Controllers;

use App\Order;
use App\QuoteApproval;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserQuotationController extends Controller
{
    /**
     * Approve quotation based on email or click-through from pending page
     * @param $quotation
     * @param $token
     * @return mixed
     */
    public function approveQuotation($quotation, $token)
    {

        $order = Order::whereHas('quoteApprovals',function($query) use($token,$quotation){
            $query->where([
                'token'=>$token,
                'order_id'=>$quotation,
                'completed'=>false
            ]);
        })->first();

        if($order==null){
            abort(404);
        }

//        $order->quoteApprovals->first()->completed = true;
//        $order->quoteApprovals->first()->save();


        return $order->quoteApprovals->first();



    }
}
