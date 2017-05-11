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
     * Display the form to create the quote
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
//        return response()->json($request->all(),500);
    $customer = User::find($request->customer_id);
    $staff = Sentinel::getUser();

        $order = new Order;
        $order->customer_id= $customer->id;
        $order->address_id = $request->address_id;
        $order->staff_id = $staff->id;
        $order->branch_id = $request->branch_id;
        $order->state_id = 1;
        $order->discount = 0.0;
        $order->due_date = Carbon::now();

        $order->save();

//        return $request->all();
//        \Log::info(['requestData'=>$request->all()]);

        foreach($request->order as $line){

            $order->orderProducts()->create([
                'product_id'=>$line['product_id'],
                'paper_id'=>$line['paper_id'],
                'size_id'=>$line['size_id'],
                'qty'=>$line['qty'],
                'description'=>$line['description']
            ]);

            \Log::info($line['description']);
        }

//        event(new QuoteCreated($customer,$order));
//        return response()->json(['test'=>$request->all()],500);

        $request->session()->flash('success', 'The quote was created successfully');
        $request->session()->flash('notification', 'true');

        return response()->json(['redirect'=>action('Admin\QuotationController@index')],200);

//    return redirect()->action('Admin\QuotationController@index')->with('success','Quotation successfully created');

    }

    public function show(Order $quotation)
    {
        $customers= User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->get()->pluck('full_name','id');
        $categories = Category::has('products')->get()->pluck('name','id');

        $quotation->load(['state'=>function($query) {
            $query->where('id',10);
        },'customer','OrderProducts','OrderProducts.product','branch'])->get();

//        return $quotation;

        return view('quote.view',compact('customers','categories','quotation'));
    }

    public function edit(Order $quotation)
    {
        $customers= User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->has('addresses')->get()->pluck('full_name','id');
        $staff = Sentinel::findRoleBySlug('staff')->users->pluck('full_name','id');
        $categories = Category::has('products')->get()->pluck('name','id');
        $branches = Branch::pluck('name','id');



        $quotation->load('customer.addresses','staff','orderProducts.product','orderProducts.paper','orderProducts.size','branch');
//        return $quotation;
        return view('quote.edit')->with([
            'customers'=>$customers,
            'categories'=>$categories,
            'branches'=>$branches,
            'staff'=>$staff,
            'quotation'=>$quotation
        ]);
    }

    public function update(Order $quotation, CreateQuote $request)
    {

        $quotation->customer_id= $request->customer_id;
        $quotation->address_id = $request->address_id;
        $quotation->staff_id = $request->staff_id;
        $quotation->branch_id = $request->branch_id;

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
//        return redirect()->back()->with([
//            'success'=>'Quotation Updated Successfully',
//            'notification'=>'true'
//        ]);
    }

}
