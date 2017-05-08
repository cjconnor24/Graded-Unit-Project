<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use App\QuoteApproval;
use App\State;
use Sentinel;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserQuotationController extends Controller
{

    /**
     * Load all active quotations belonging to the user and display them in a list
     * @return $this
     */
    public function index()
    {
        $user = Sentinel::getUser();

        $quotations = Order::whereHas('customer',function($query){
            $query->where('id',Sentinel::getUser()->id);
        })->whereHas('state',function($query){
            $query->where('name','quote');
        })->whereHas('quoteApprovals',function($query) {
            $query->where('completed',false);
        })->paginate();


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

        $quote = Order::whereHas('quoteApprovals',function($query) use($token,$quotation){
                $query->where([
                    'token'=>$token,
                    'order_id'=>$quotation,
                    'completed'=>false
                ]);
            })->whereHas('state',function($query){
                $query->where('name','quote');
        })->first();


        if($quote==null){
            abort(404);
        }


        $quote->quoteApprovals->last()->approve();

        $state = State::where('name','order')->first();
        $status = OrderStatus::where('name','LIKE','%payment%')->first();
        $quote->state()->associate($state);
        $quote->orderStatus()->associate($status);
        $quote->save();

        return redirect()->action('UserQuotationController@index')->with('success','Your quote has been approved and progressed to orders.');
    }

    public function show(Order $quotation)
    {
        $quotation->load('customer','OrderProducts.product','OrderProducts.paper','address','staff','branch');

//        return $quotation;
        return view('userviews.quote.view')->with('quotation',$quotation);
    }
}
