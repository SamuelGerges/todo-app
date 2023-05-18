<?php

namespace App\Http\Controllers\API;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductExport(),'export1.xlsx');
    }


    public function import()
    {

    }
}
