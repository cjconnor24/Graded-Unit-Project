<?php

namespace App\Http\Controllers;

use App\Mail\UserQuoteRejected;
use App\Order;
use App\OrderStatus;
use App\QuoteApproval;
use App\QuoteRejection;
use App\State;
use Illuminate\Support\Facades\Mail;
use Sentinel;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Quotation controller to manage customer interaction.
 *
 * Handles all functionality related to customer quotations
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
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
        })->whereDoesntHave('rejection')->paginate();

        return view('userviews.quote.index')->with('quotations',$quotations);

    }

    /**
     * Approve quotation based on email or click-through from pending page
     * @param Order $quotation The quotation to be approved
     * @param string $token The quotation token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveQuotation(Order $quotation, $token)
    {

        // EAGER LOGIN THE APPROVALS
        $quotation->load(['quoteApprovals'=>function($query) use($token){
            $query->where('token',$token);
        }]);

        // MAKE SURE THERE IS AN APPROVAL
        if(count($quotation->quoteApprovals)!==1){
            abort(404);
        }

        $quotation->quoteApprovals->last()->approve();

        // UPDATE THE STATE
        $state = State::where('name','order')->first();
        $status = OrderStatus::where('name','LIKE','%payment%')->first();
        $quotation->state()->associate($state);
        $quotation->orderStatus()->associate($status);
        $quotation->save();

        return redirect()->action('UserOrderController@show',['order'=>$quotation->id])->with(['notification'=>true,'success'=>'Your quote has been approved and progressed to orders.']);
    }

    /**
     * Reject quotation via Ajax POST from view
     * @param Request $request
     * @param Order $quotation
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectQuotation(Request $request, Order $quotation)
    {

        $quotation->rejection()->create([
            'reason'=>$request->reason
        ]);

        $state = State::where('name','cancelled')->first();
        $quotation->state()->associate($state);

        $quotation->save();

        // MAIL THE USER TO CONFIRM THE REJECTION
        Mail::to($quotation->customer->email)->cc($quotation->staff->email)->send(new UserQuoteRejected($quotation));

        $request->session()->flash('success', 'The quote was rejected');
        $request->session()->flash('notification', 'true');

        return response()->JSON(['redirect'=>'/quotations']);
    }

    /**
     * Display the quotation
     * @param Order $quotation
     * @return $this
     */
    public function show(Order $quotation)
    {
        if($quotation->state->name=='quote') {

            $quotation->load([
                'customer',
                'OrderProducts.product',
                'OrderProducts.paper',
                'QuoteApprovals' => function ($query) {
                    $query->select('order_id', 'token')->orderBy('id', 'DESC')->first();
                },
                'address',
                'staff',
                'branch'
            ]);


            return view('userviews.quote.view')->with('quotation', $quotation);

        } else {
            abort(404);
        }

    }
}
