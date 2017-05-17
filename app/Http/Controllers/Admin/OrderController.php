<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNote;
use App\Note;
use App\Order;
use App\OrderStatus;
use App\User;
use Sentinel;
use Illuminate\Http\Request;

/**
 * Class OrderController
 * Management of quotes / orders within application
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{

    /**
     * Show a list of all active orders
     * @return mixed
     */
    public function index()
    {
        $orders = Order::wherehas('state',function($query){
            $query->where('name','order');
        })->with(['customer'=>function($query) {
            $query->select('id','first_name','last_name');
        },'orderstatus'=>function($query){
            $query->select('id','name');
        }])->paginate();

        return view('order.index')->with('orders',$orders);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * Display the order and allow the admin to update the status of the order
     * @param Order $order
     * @return $this
     */
    public function show(Order $order)
    {
        $order->load([
            'branch',
            'staff',
            'state',
            'customer',
            'orderProducts.product',
            'orderProducts.paper',
            'orderProducts.size',
            'address',
            'payments',
            'notes'=>function($query){
                $query->orderBy('id','DESC');
            },
            'notes.user'=>function($query){
                $query->select('id','first_name','last_name');
            }
        ]);

        $statuses = OrderStatus::pluck('name','id');
        $staff = Sentinel::findRoleBySlug('staff')->users->pluck('full_name','id');

//        dd($order);

        return view('order.view')->with([
            'order'=>$order,
            'statuses'=>$statuses,
            'staff'=>$staff
        ]);
}

    /**
     * Add note to an order
     * @param Order $order
     * @param StoreNote $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNote(Order $order, StoreNote $request)
    {

        $order->addNote($request->input('content'),Sentinel::getUser()->id);

        return redirect()->back()->with('success','Note Added');

    }

    public function updateStatus(Order $order, OrderStatus $status, Request $request)
    {

//        dd([$order,$status]);

        $order->orderStatus()->associate($status);
        $order->save();

        return response()->json(['success'=>'Updated successfully'],200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }




}
