<?php

namespace AFG\Http\Controllers;

use Illuminate\Http\Request;

use AFG\Http\Requests;
use AFG\Http\Controllers\Controller;

class InvoiceController extends Controller
{

    public function create($team)
    {
        return view('invoices.create')
            ->withTeam($team);
    }
}
