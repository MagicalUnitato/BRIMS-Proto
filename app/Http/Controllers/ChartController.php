<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use Illuminate\Http\Request;
use DB;
class ChartController extends Controller
{
    public function index(){
    // Get users grouped by age
    $download = DB::table('user_data')
                      ->select(DB::raw('AVG(download) as download'), DB::raw('serviceProvider as total'))
                      ->groupBy('serviceProvider')
                      ->pluck('download','total')->all();
    $upload = DB::table('user_data')
                      ->select(DB::raw('AVG(upload) as upload'), DB::raw('serviceProvider as total'))
                      ->groupBy('serviceProvider')
                      ->pluck('upload','total')->all();
    // Generate random colours for the groups
    for ($i=0; $i<=count($download); $i++) {
                $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            }
    // Prepare the data for returning with the view
    $chartDownloadAve = new Chart;
    $chartDownloadAve->labels = (array_keys($download));
    $chartDownloadAve->dataset = (array_values($download));
    $chartDownloadAve->colours = $colours;

    $chartUploadAve = new Chart;
    $chartUploadAve->labels = (array_keys($upload));
    $chartUploadAve->dataset = (array_values($upload));
    $chartUploadAve->colours = $colours;
    // still have problems on input will push once resolved
    //$serviceProvInput = Input::post('');
    //$month = Input::post('');

    $chartDownloadMonth = new Chart;
    $chartUploadMonth = new Chart;
    return view('charts.index', compact('chartDownloadAve','chartUploadAve'));
    }
}
