<?php

namespace App\Http\Controllers;
use App\Models\Chart;
use Illuminate\Http\Request;
use DB;
class ApiController extends Controller
{
    public function getAverageSpeeds(){
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
        

        $chartUploadAve = new Chart;
        $chartUploadAve->labels = (array_keys($uploadAve));
        $chartUploadAve->dataset = (array_values($uploadAve));

        return response()->json(compact('chartDownloadAve','chartUploadAve'));
    }

    public function getMonthlySpeedProvider($serviceProvider,$startMonth,$endMonth,$startYear,$endYear){
        $downloadMonth = DB::table('user_data')
        ->select('download','created_at','serviceProvider','id')
        ->whereBetween('created_at',[$startYear."".$startMonth.'01',$endYear."".$endMonth.'31'])
        ->having('serviceProvider','=',$serviceProvider)
        ->pluck('download','created_at','serviceProvider')->all();

        $lineGraphMonthDownload = new Chart;
        $lineGraphMonthDownload->labels = (array_keys($downloadMonth));
        $lineGraphMonthDownload->dataset = (array_values($downloadMonth)); 
        return response()->json(compact('lineGraphMonthDownload'));
    }
}
