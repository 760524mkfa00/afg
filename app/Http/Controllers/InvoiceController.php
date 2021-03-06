<?php

namespace AFG\Http\Controllers;

use AFG\Invoice;
use AFG\TaxRate;
use AFG\Tracking;
use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Http\Requests\InvoiceRequest;
use AFG\Http\Controllers\Controller;

class InvoiceController extends Controller
{

    public function create($team)
    {
        $tax = TaxRate::lists('rate', 'id');

        return view('invoices.create')
            ->withTeam($team)
            ->withTax($tax);
    }

    public function store(InvoiceRequest $request)
    {

        $tracking_id = $request->get('tracking_id');

        $tracking = Tracking::find($tracking_id);

        $request['holdback'] = $request->has('holdback') ? true : false;
        $request['additional'] = $request->has('additional') ? true : false;

        $tracking->invoices()->save(new Invoice($request->all()));

        return \Redirect::route('tracking.invoices', $tracking_id)->withMessage('Invoice Added');
    }

    public function edit($id, $team)
    {
        $data = Invoice::findOrNew($id);
        $tax = TaxRate::lists('rate', 'id');
        return view('invoices.edit')
            ->withData($data)
            ->withTeam($team)
            ->withTax($tax);
    }

    public function update($id, InvoiceRequest $request)
    {
        $tracking_id = $request->get('tracking_id');

        $request['holdback'] = $request->has('holdback') ? true : false;
        $request['additional'] = $request->has('additional') ? true : false;

        Invoice::find($id)->update($request->all());

        return \Redirect::route('tracking.invoices', $tracking_id)->withMessage('Invoice Updated');
    }
}
