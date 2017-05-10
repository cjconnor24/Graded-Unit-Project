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
     * Create new quotation
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


    public function store(CreateQuote $request)
    {

//        dd($request->all());

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

        foreach($request->order as $line){
            $order->orderProducts()->create([
                'product_id'=>$line['product_id'],
                'paper_id'=>$line['paper_id'],
                'size_id'=>$line['size_id'],
                'qty'=>$line['qty'],
                'description'=>''
            ]);
        }

        event(new QuoteCreated($customer,$order));

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

}
