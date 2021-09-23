<?php

namespace App\Http\Controllers;
use App\Models\Chart;
use Illuminate\Http\Request;
use DB;
class ChartFormController extends Controller
{
    public function index(Request $request){
        //still have problems on input will push once resolved
        //$serviceProviderInput = $request->input('name');
        $startMonthInput = $request->input('selectStartMonth');
        $endMonthInput = $request->input('selectEndMonth');
        $yearInput = $request->input('selectYear');
        //sql SELECT `user_data`.`upload`, `user_data`.`download`, `user_data`.`created_at` 
        //FROM `user_data` WHERE `user_data`.`created_at` > '2020-10-01' && `user_data`.`created_at` < '2020-10-31' ORDER BY `created_at` ASC
        $downloadMonth = DB::table('user_data')
                        ->select('download',DB::raw('created_at as total'))
                        ->where('created_at','>',$yearInput.'-'.$startMonthInput.'01')
                        //->where('created_at',$endMonthInput)
                        //->groupBy('serviceProvider')
                        ->pluck('download','total')->all();
        $uploadMonth = DB::table('user_data')
                        ->select('upload','created_at as total')
                        ->where('created_at','>',$yearInput.'-'.$startMonthInput.'01')
                        //->where('created_at',$endMonthInput)
                        //->groupBy('serviceProvider')
                        ->pluck('upload','total')->all();
        $lineGraphMonthDownload = new Chart;
        $lineGraphMonthDownload->labels = (array_keys($downloadMonth));
        $lineGraphMonthDownload->dataset = (array_values($downloadMonth)); 

        $lineGraphMonthUpload = new Chart;
        $lineGraphMonthUpload->labels = (array_keys($uploadMonth));
        $lineGraphMonthUpload->dataset = (array_values($uploadMonth));

        return view('charts.index', compact('lineGraphMonthDownload','lineGraphMonthUpload'));
    }
}
