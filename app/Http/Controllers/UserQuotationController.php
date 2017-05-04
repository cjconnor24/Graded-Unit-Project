<?php

namespace App\Http\Controllers;

use App\Order;
use App\QuoteApproval;
use Sentinel;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserQuotationController extends Controller
{

    public function index()
    {
        $user = Sentinel::getUser();
        $quotations = Order::whereHas('quoteApprovals')->where('customer_id',$user->id)->orderBy('id','desc')->paginate();
//        $quotations = Order::whereHas('quoteApprovals')->where('id',5)->paginate();


        return view('userviews.quote.index')->with('quotations',$quotations);

    }

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

        return view('quote._invoicetable')->with('quotation',$order);



    }
}
