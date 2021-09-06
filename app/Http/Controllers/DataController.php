<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userData;
use DataTables;

class DataController extends Controller
{
    public function index()
    {
        return view('welcome');
    }


    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = userData::latest()->get();
            return Datatables::of($data)
                ->make(true);
        }       
    }
    /** GET UPLOAD AND DOWNLOAD SPEED FOR MONTH FROM A SPECIFIC PROVIDER 
     * SELECT `upload`,`download`,`created_at` FROM `user_data` WHERE `serviceProvider` = 'DITO' ORDER BY `created_at`;
     * 
    */
    public function getChartDownload(Provider $provider){
        $result = \DB::table('userData')
            ->select('download')
            ->where('serviceProvider','=','$provider')
            ->orderBy('created_at','ASC')
            ->get();
        return response()->json($result);
    }
}