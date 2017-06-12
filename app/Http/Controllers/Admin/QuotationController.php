<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Category;
use App\Events\QuoteCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateQuote;
use App\Order;
use App\OrderProduct;
use App\State;
use App\User;
use Carbon\Carbon;
use Sentinel;
use Illuminate\Http\Request;

/**
 * Controller for managing quotations
 * @package App\Http\Controllers\Admin
 * @author Chris Connor <chris@chrisconnor.co.uk>
 */
class QuotationController extends Controller
{
    /**
     * Display a list of quotations
     * @return $this
     */
    public function index()
    {

        $quotations = Order::with('customer','OrderProducts.product')->whereHas('state',function($query){
            $query->where('name','quote');
        })->orderBy('id','desc')->paginate();


        return view('quote.index')->with('quotations',$quotations);
    }

    /**
     * Display the form to create a quotation
     * @return $this
     */
    public function create()
    {
        $customers= User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->has('addresses')->get()->pluck('full_name','id');
        $categories = Category::has('products')->get()->pluck('name','id');
        $branches = Branch::pluck('name','id');

        return view('quote.create')->with(['customers'=>$customers,'categories'=>$categories,'branches'=>$branches]);
    }


    /**
     * Save the quote by creating new order
     * @param CreateQuote $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateQuote $request)
    {

    $customer = User::find($request->customer_id);
    $staff = Sentinel::getUser();

        $order = new Order;
        $order->customer_id= $customer->id;
        $order->address_id = $request->address_id;
        $order->staff_id = $staff->id;
        $order->branch_id = $request->branch_id;
        $order->state_id = 1;
        $order->discount = 0.0;
        $order->due_date = Carbon::parse($request->due_date);

        $order->save();

        foreach($request->order as $line){

            $order->orderProducts()->create([
                'product_id'=>$line['product_id'],
                'paper_id'=>$line['paper_id'],
                'size_id'=>$line['size_id'],
                'qty'=>$line['qty'],
                'description'=>$line['description']
            ]);
            
        }

        // TRIGGER THE QUOTE CREATED EVENT - CREATE APPROVAL AND EMAIL
        try {
            event(new QuoteCreated($customer, $order));
        }
        catch (\Swift_TransportException $e){

        // LOG DETAILS
        \Log::error('MAIL SENDING FAILED. See logs for activation details.');

    }

        $request->session()->flash('success', 'The quote was created successfully');
        $request->session()->flash('notification', 'true');

        return response()->json(['redirect'=>action('Admin\QuotationController@index')],200);

    }

    /**
     * Display the quotation
     * @param Order $quotation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $quotation)
    {

        if($quotation->state->name!=='quote'){
            abort(404,'The quote you\'re trying to access doesn\'t exists.');
        }

        $customers= User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->get()->pluck('full_name','id');
        $categories = Category::has('products')->get()->pluck('name','id');

        $quotation->load(['state'=>function($query) {
            $query->where('id',10);
        },'customer','OrderProducts','OrderProducts.product','branch'])->get();

        return view('quote.view',compact('customers','categories','quotation'));
    }

    /**
     * Edit the order passed through
     * @param Order $quotation Quotation to be edited
     * @return $this
     */
    public function edit(Order $quotation)
    {
        $customers= User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->has('addresses')->get()->pluck('full_name','id');

        $staff = Sentinel::findRoleBySlug('staff')->users->pluck('full_name','id');
        $categories = Category::has('products')->get()->pluck('name','id');
        $branches = Branch::pluck('name','id');

        /**
         * EAGER LOAD THE RELATIONSHIPS
         */
        $quotation->load('customer.addresses','staff','orderProducts.product','orderProducts.paper','orderProducts.size','branch');

        return view('quote.edit')->with([
            'customers'=>$customers,
            'categories'=>$categories,
            'branches'=>$branches,
            'staff'=>$staff,
            'quotation'=>$quotation
        ]);
    }

    /**
     * Update the order based on the changes
     * @param Order $quotation
     * @param CreateQuote $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Order $quotation, CreateQuote $request)
    {

        $quotation->customer_id= $request->customer_id;
        $quotation->address_id = $request->address_id;
        $quotation->staff_id = $request->staff_id;
        $quotation->branch_id = $request->branch_id;
        $quotation->due_date = Carbon::parse($request->due_date);

        $quotation->save();

        // REMOVE ANY CURRENT ORDER LINES AND UPDATE
        $quotation->orderProducts()->delete();

        foreach($request->order as $line){
            $quotation->orderProducts()->create([
                'product_id'=>$line['product_id'],
                'paper_id'=>$line['paper_id'],
                'size_id'=>$line['size_id'],
                'qty'=>$line['qty'],
                'description'=>$line['description']
            ]);
        }

        $request->session()->flash('success', 'The quote was updated successfully');
        $request->session()->flash('notification', 'true');

        return response()->json(['redirect'=>action('Admin\QuotationController@index')],200);

    }

}