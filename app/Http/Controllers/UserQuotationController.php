<?php

namespace App\Http\Controllers;

use App\Order;
use App\QuoteApproval;
use App\State;
use Sentinel;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserQuotationController extends Controller
{

    public function index()
    {
        $user = Sentinel::getUser();

        $quotations = Order::whereHas('customer',function($query){
            $query->where('id',Sentinel::getUser()->id);
        })->whereHas('state',function($query){
            $query->where('name','quote');
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
        $quote->state()->associate($state);
        $quote->save();

        return redirect()->action('UserQuotationController@index')->with('success','Your quote has been approved and progressed to orders.');


    }
}
