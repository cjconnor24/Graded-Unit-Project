<?php

namespace App\Http\Controllers\Admin;

use App\Category;
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
        $quotations = Order::whereHas('state',function($query){
            $query->where('name','quote');
        })->get();

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
        })->get()->pluck('full_name','id');
        $categories = Category::has('products')->get()->pluck('name','id');

        return view('quote.create')->with(['customers'=>$customers,'categories'=>$categories]);
    }

    /**
     * Create the order and associated order lines with approriate relationships
     * @param Request $request
     */
    public function store(CreateQuote $request)
    {
        \Log::info($request);
//dd($request->all());
//        return;

//            dd($request->all());

//        // VALIDATE ORDER
//     $this->validate($request,[
//         'customer_id'=>'required',
//         'address_id'=>'required',
//         'order'=>'required|array',
//         'order.*.product_id'=>'required|integer',
//         'order.*.paper_id'=>'required|integer',
//         'order.*.size_id'=>'required|integer',
//     ]);
//
//     if($errors){
//         return response()->json(['error'=>"$errors"],500);
//     }



    $customer = User::find($request->customer_id);
//    $customer->addresses->find($request->address_id);

//    $state = State::find(1);
    $staff = Sentinel::getUser();


        $order = new Order;
        $order->customer_id= $customer->id;
        $order->address_id = $request->address_id;
        $order->staff_id = $staff->id;
        $order->branch_id = 1;
        $order->state_id = 1;
        $order->discount = 0.0;
        $order->due_date = Carbon::now();

        $order->save();

        foreach($request->order as $line){
//            print_r($line);
            $order->orderProducts()->create([
                'product_id'=>$line['product_id'],
                'paper_id'=>$line['paper_id'],
                'size_id'=>$line['size_id'],
                'qty'=>$line['qty'],
                'description'=>''
            ]);
    }

//    return json
        $request->session()->flash('success', 'The quote was created successfully');
        return response()->json(['redirect'=>action('Admin\QuotationController@index')],200);

//    return redirect()->action('Admin\QuotationController@index')->with('success','Quotation successfully created');

    }

}
