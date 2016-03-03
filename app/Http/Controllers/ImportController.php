<?php

namespace AFG\Http\Controllers;

use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Http\Controllers\Controller;
use AFG\Services\Tasks\ExcelImportTask;


class ImportController extends Controller
{

    protected $task;

    public function __construct(ExcelImportTask $task)
    {
        $this->task = $task;
    }

    public function index()
    {
        $file = [];
        return view('import.index')
            ->withFile($file);
    }

    public function load(Request $request)
    {
        $excel = $request->file('file');

        $this->task->upload($excel);
        $file = $this->task->attach();


        return view('import.index')
            ->withFile($file);

    }
}
