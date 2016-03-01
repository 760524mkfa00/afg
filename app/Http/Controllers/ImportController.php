<?php

namespace AFG\Http\Controllers;

use AFG\Invoice;
use AFG\Http\Requests;
use Maatwebsite\Excel\Excel;
use Illuminate\Http\Request;
use AFG\Http\Controllers\Controller;

class ImportController extends Controller
{

    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function index()
    {
        $file = [];
        return view('import.index')
            ->withFile($file);
    }

    public function load(Request $request)
    {
        $path = $request->file('file');

        $file = $this->excel->load($path)->get();
        $invoices = Invoice::all();

        return view('import.index')
            ->withFile($file);

    }
}
