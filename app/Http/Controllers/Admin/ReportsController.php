<?php

namespace App\Http\Controllers\Admin;

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

        $customers = User::whereHas('roles',function($query){
            $query->where('slug','customer');
        })->select("first_name",'last_name','email','telephone','created_at')->get();

//        $pdf = PDF::loadView('reports.templates.customer',['customers'=>$customers]);
                $pdf = PDF::loadView('reports.templates.temp',['customers'=>$customers]);
        return $pdf->download('invoice.pdf');

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
