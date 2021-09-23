<?php

namespace App\Http\Controllers;
use App\Models\Chart;
use Illuminate\Http\Request;
use DB;
class ChartController extends Controller
{
    public function index(){
        // Get download and upload average
        $downloadAve = DB::table('user_data')
                        ->select(DB::raw('AVG(download) as download'), DB::raw('serviceProvider as total'))
                        ->groupBy('serviceProvider')
                        ->pluck('download','total')->all();
        $uploadAve = DB::table('user_data')
                        ->select(DB::raw('AVG(upload) as upload'), DB::raw('serviceProvider as total'))
                        ->groupBy('serviceProvider')
                        ->pluck('upload','total')->all();
        // Generate random colours for the average UP and DL chart
        for ($i=0; $i<=count($downloadAve); $i++) {
                    $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        // Prepare the data for returning with the view
        $chartDownloadAve = new Chart;
        $chartDownloadAve->labels = (array_keys($downloadAve));
        $chartDownloadAve->dataset = (array_values($downloadAve));
        $chartDownloadAve->colours = $colours;

        $chartUploadAve = new Chart;
        $chartUploadAve->labels = (array_keys($uploadAve));
        $chartUploadAve->dataset = (array_values($uploadAve));
        $chartUploadAve->colours = $colours;
        
        //still have problems on input will push once resolved

        //$serviceProviderInput = $request->input('name');
        //$startMonthInput = $request->input('selectStartMonth');
        //$endMonthInput = $request->input('selectEndMonth');
        //$yearInput = $request->input('selectYear');

        //sql SELECT `user_data`.`upload`, `user_data`.`download`, `user_data`.`created_at` 
        //FROM `user_data` WHERE `user_data`.`created_at` > '2020-10-01' && `user_data`.`created_at` < '2020-10-31' ORDER BY `created_at` ASC
        $downloadMonth = DB::table('user_data')
                        ->select('download','created_at','serviceProvider')
                        ->whereBetween('created_at',['20200101','20201231'])
                        ->having('serviceProvider','=','DITO')
                        ->pluck('download','created_at')->all();
        $uploadMonth = DB::table('user_data')
                        ->select('upload','created_at','serviceProvider')
                        ->whereBetween('created_at',['20200101','20201231'])
                        ->having('serviceProvider','=','DITO')
                        ->pluck('upload','created_at')->all();
        $lineGraphMonthDownload = new Chart;
        $lineGraphMonthDownload->labels = (array_keys($downloadMonth));
        $lineGraphMonthDownload->dataset = (array_values($downloadMonth)); 

        $lineGraphMonthUpload = new Chart;
        $lineGraphMonthUpload->labels = (array_keys($uploadMonth));
        $lineGraphMonthUpload->dataset = (array_values($uploadMonth));

        return view('charts.index', compact('chartDownloadAve','chartUploadAve','lineGraphMonthDownload','lineGraphMonthUpload'));
        //return json_encode to return json values
    }
    public function chartForm(Request $request){
        $serviceProviderInput = $request->get('serviceProviderName');
        $startMonthInput = $request->get('selectStartMonth');
        $endMonthInput = $request->get('selectEndMonth');
        $yearInput = $request->get('selectYear');

        $downloadMonth = DB::table('user_data')
        ->select('download','created_at','serviceProvider')
        ->whereBetween('created_at',[$yearInput."".$startMonthInput.'01',$yearInput."".$endMonthInput.'31'])
        ->having('serviceProvider','=',$serviceProviderInput)
        ->pluck('download','created_at','serviceProvider')->all();

        $lineGraphMonthDownload = new Chart;
        $lineGraphMonthDownload->labels = (array_keys($downloadMonth));
        $lineGraphMonthDownload->dataset = (array_values($downloadMonth)); 
        $lineGraphMonthDownload->anotherLabel = (array_values($downloadMonth)); 
        return response()->json($lineGraphMonthDownload);
    }
}
