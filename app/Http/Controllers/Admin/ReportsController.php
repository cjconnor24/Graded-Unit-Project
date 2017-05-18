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

//        $users = \DB::table('users')
//            ->join('orders','users.id','orders.customer_id')
//            ->join('order_product','orders.id','order_id')
//            ->join('products','products.id','order_product.product_id')
//            ->select('users.first_name','users.last_name','products.name','orders.id','order_product.description')
//            ->get();

//        $popularProducts = \DB::table('order_product')
//            ->join('order_product','orders.id','order_id')
//            ->join('products','products.id','order_product.product_id')
//            ->join('papers','papers.id','order_product.paper_id')
//            ->join('sizes','sizes.id','order_product.size_id')
//            ->join('states','states.id','orders.status_id')
//            ->selectRaw('COUNT(*), products.name as Product')
//            ->groupBy('products.id')
//            ->orderBy('Total','DESC')
//            ->get();

        $popularProducts = \DB::table('order_product')
            ->join('products','products.id','order_product.product_id')
            ->selectRaw('COUNT(*), SUM(products.price), order_product.order_id')
            ->groupBy('order_product.order_id')
            ->orderBy('order_product.order_id','DESC')
            ->get();

        return $popularProducts;

//        return $users;
        $array = array();
        foreach($popularProducts as $line){
            $array[] = (array)$line;
        }

        return $this->downloadPDF($array,'Top Products / Configs');
//        return $this->downloadCSV($array);
        //            ->join('orders','users.id','orders.customer_id')
//            ->select('users.first_name','users.last_name','products.name','orders.id','order_product.description')

//        dd($users);
//        return $this->downloadCSV($users);

//        return $users;


//        return $this->downloadCSV($users);


    }

    public function show()
    {

        $customers = User::select('first_name','last_name','email','last_login')->get()->toArray();

            return $this->downloadCSV($customers);
//        return $this->downloadPDF($customers,'Customer Report');

    }


    /**
     * Takes array data and returns an HTML table for use in PDF report
     * @param $data
     * @return string
     */
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

    /**
     * Takes data and renders a pdf
     * @param $data
     * @param string $title
     * @param array $paper
     * @return mixed
     */
    private function downloadPDF($data, $title = "Report",$paper = ['A4','portrait']){

        $pdf = PDF::loadView('reports.templates.template',[
            'title'=>$title,
            'table'=>$this->buildTable($data)
        ]);

        $pdf->setPaper($paper[0], $paper[1]);

        return $pdf->stream();

    }

    /**
     * Takes array data and converts this to CSV report
     * @param $data
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
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
