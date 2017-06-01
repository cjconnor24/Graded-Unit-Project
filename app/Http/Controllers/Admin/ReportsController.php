<?php
namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Order;
use App\OrderStatus;
use App\State;
use App\User;
use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

/**
 * Class ReportsController Manages creation and export of reports
 *
 * @author Chris Connor chris@chrisconnor.co.uk
 * @package App\Http\Controllers\Admin
 */
class ReportsController extends Controller
{

    /**
     * Displays the Reports Dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Report Dashboard View
     */
    public function index()
    {

        return view('reports.index');
    }

    /**
     * Displays the customer reporting view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Customer Reporting View
     */
    public function customers()
    {

        return view('reports.customerReport');
    }

    /**
     * Processes the request from the form and builds the query based on the options
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function customersPost(Request $request)
    {

        if(!$request->total_spend){

        $query = \DB::table('role_users')
            ->join('roles','roles.id','role_users.role_id')
            ->join('users','users.id','role_users.user_id')
            ->where('roles.slug','customer')
            ->selectRaw('users.id as customer_id, users.first_name,users.last_name,users.email,users.created_at as registered, users.telephone');



        } else {

            $query = \DB::table('order_product')
                ->join('products', 'products.id', 'order_product.product_id')
                ->join('orders', 'orders.id', 'order_product.order_id')
                ->join('users', 'users.id', 'orders.customer_id')
                ->selectRaw("users.id AS customer_id, users.first_name,users.last_name, users.email, users.created_at as registered, SUM(products.price * order_product.qty) AS total_spend ")
                ->groupBy('users.id')
                ->where('orders.state_id', '2')
                ->orderBy('total_spend','DESC');

        }

        if($request->start_date){
            $query->where('users.created_at','>=',Carbon::parse($request->start_date));
        }

        if($request->end_date){
            $query->where('users.created_at','<=',Carbon::parse($request->end_date));
        }

        $result = $query->get()->toArray();



        if(count($result)>0){

            if ($request->report_type == 'csv') {
                return $this->downloadCSV($this->convertToArray($result));
            } else {
                return $this->downloadPDF($this->convertToArray($result), 'Customer Report');
            }

        } else {

            return back()->with('error','There are no results');

        }

    }


    /**
     * Display the form for creating an order report
     * @return $this
     */
    public function orders()
    {
        $states = State::pluck('name','id');
        $statuses = OrderStatus::pluck('name','id');


        return view('reports.orderReport')
            ->with([
                'states'=>$states,
                'statuses'=>$statuses
            ]);
    }

    /**
     * Process the options from the form and build the query for the report.
     * @param Request $request
     * @return $this|mixed|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function ordersPost(Request $request)
    {

        $results = \DB::table('orders')
        ->join('states','states.id','orders.state_id')
        ->join('users','users.id','orders.customer_id')
        ->join('order_statuses','order_statuses.id','orders.status_id');

        $results->selectRaw(
            'orders.id AS OrderNumber,
            users.id as CustomerID,
            CONCAT(users.first_name," ",users.last_name) AS CustomerName,
            orders.created_at AS CreatedON,
            UCASE(states.name) AS OrderType,
            order_statuses.name');

        // SEARCH START DATE
        if(isset($request->start_date)){

            $results->where('orders.created_at','>=',Carbon::parse($request->start_date));
        }

        // SEARCH END DATE
        if(isset($request->end_date)){

            $results->where('orders.created_at','<=',Carbon::parse($request->end_date));
        }

        // ORDER TYPE
        if(isset($request->state_id)){
            $results->where('orders.state_id',$request->state_id);
        }

        // STATUS
        if(isset($request->status_id)){
            $results->where('orders.status_id',$request->status_id);
        }

        // CUSTOMER NAME
        if(isset($request->customer_name)){
            $results->where('users.first_name','LIKE',$request->customer_name)
            ->orWhere('users.last_name','LIKE',$request->customer_name);
        }


        // CONVERT THE RESULTS TO AN ARRAY
        $temp = $results->get()->toArray();

        if(count($temp)>0) {

            if ($request->report_type == 'csv') {
                return $this->downloadCSV($this->convertToArray($temp));
            } else {
                return $this->downloadPDF($this->convertToArray($temp), 'Order Report');
            }

        } else {

            return redirect()->action('Admin\ReportsController@orders')->withErrors('There are no results');

        }

    }

    /**
     * Flattens any additional objects inside an array to arrays
     * @param $data Data to be converted
     * @return array
     */
    private function convertToArray($data){
        $array = array();
        foreach($data as $line){
            $array[] = (array)$line;
        }
        return $array;
    }

    /**
     * Takes array data and returns an HTML table for use in PDF report
     * @param object[] $data Data to be converted
     * @return string HTML Table string
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
     * @param string[] $data Data to be rendered in PDF
     * @param string $title Title of the report
     * @param string[] $paper Paper and size options
     * @return mixed PDF download stream
     */
    private function downloadPDF($data, $title = "Report",$paper = ['A4','portrait']){

        $pdf = PDF::loadView('reports.templates.template',[
            'title'=>$title,
            'table'=>$this->buildTable($data)
        ]);

        $pdf->setPaper($paper[0], $paper[1]);

//        return $pdf->stream();
        return $pdf->download();

    }

    /**
     * Takes array data and converts this to CSV report
     * @param string[] $data Data to be rendered into CSV file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse CSV download stream
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
