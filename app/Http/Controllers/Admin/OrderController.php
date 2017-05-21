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
 * Order Controller
 *
 * Management of quotes / orders within the application
 * @package App\Http\Controllers
 * @author Chris Connor <chris@chrisconnor.co.uk>
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
     * Display the order and allow the admin to update the status of the order
     * @param Order $order The order to view
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

        return view('order.view')->with([
            'order'=>$order,
            'statuses'=>$statuses,
            'staff'=>$staff
        ]);
}

    /**
     * Add a note to an order
     * @param Order $order The order to add the note to
     * @param StoreNote $request The validated post request data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNote(Order $order, StoreNote $request)
    {

        $order->addNote($request->input('content'),Sentinel::getUser()->id);
        return redirect()->back()->with('success','Note Added');

    }

    /**
     * Update the status of the order via Ajax from the view
     * @param Order $order The order to update
     * @param OrderStatus $status The order status
     * @param Request $request The post request data
     * @return \Illuminate\Http\JsonResponse JSon response for jQuery
     */
    public function updateStatus(Order $order, OrderStatus $status, Request $request)
    {

        $order->orderStatus()->associate($status);
        $order->save();

        return response()->json(['success'=>'Updated successfully'],200);

    }

}
