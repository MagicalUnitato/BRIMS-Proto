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
}