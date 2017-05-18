<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Order;
use App\User;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

class ReportsController extends Controller
{

    public function index()
    {

        return view('reports.index');
    }

    public function customer()
    {

        $customers = User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->select("first_name",'last_name','email','telephone','created_at')->get()->toArray();



//        return $customers;
        return $this->downloadCSV($customers);


    }

    public function downloadPDF()
    {

        $customers = User::whereHas('orders')->get();






        $customers->map(function($user){
            $user->payment_total = $user->payments->sum(function($payment){
                return $payment->amount;
            });
            $user->order_count = $user->orders->count();
        });
//        $orders = Order::with('payments')->get();


        $sorted = $customers->sortBy('payment_total');
return        $customers->get(['email','first_name']);

        return $sorted->select('id')->get();



        return $customers;

            $customers->map(function($user){
            $user->order_count = $user->orders->count();
            $user->complete_spend = '1234';

        });



        return $customers;

        $customers = User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->select("first_name",'last_name')->get()->toArray();


//        return $customers;

//        return $this->buildTable($customers);

//        $pdf = PDF::loadView('reports.templates.customer',['customers'=>$customers]);
                $pdf = PDF::loadView('reports.templates.template',[
                    'title'=>'Customer Report',
                    'table'=>$this->buildTable($customers)
                ]);

        return $pdf->download('invoice.pdf');

    }

    private function buildTable($data){

        $table='';

        $table = '<table class="table"><thead><tr>';
        foreach(array_keys($data[0]) as $key){
            $table .= '<th>'.ucwords(str_replace("_",' ',$key)).'</th>';
        }
        $table .= '</tr></thead>';

        $table .= '<tbody>';
        foreach($data as $line){
            $table .= "<tr>";
            foreach(array_values($line) as $el){
                $table .= "<td>".$el."</td>";
            }
            $table .= "</tr>";

        }
        $table .= "</tbody></table>";


        return $table;

    }

    private function downloadCSV($data){

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=report.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        $callback = function() use ($data)
        {
            $FH = fopen('php://output', 'w');
            fputcsv($FH,array_keys($data[0]));
            foreach ($data as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }

}
