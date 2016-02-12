<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use AFG\Tracking;
use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Http\Controllers\Controller;

class TrackingController extends Controller
{

    public function create($project)
    {
        return view('tracking.create')
            ->withProject($project);
    }

    public function store(Request $request)
    {
        $project_id = $request->get('afg_id');

        $project = Afg::find($project_id);

        $project->tracking()->save(new Tracking($request->all()));

        return \Redirect::route('projects.balances', $project_id)->withMessage('Contractor Added');
    }

    public function edit($id, $project)
    {
        $data = Tracking::findOrNew($id);
        return view('tracking.edit')
            ->withData($data)
            ->withProject($project);
    }

    public function update($id, Request $request)
    {
        $project_id = $request->get('afg_id');

        Tracking::find($id)->update($request->all());

        return \Redirect::route('projects.balances', $project_id)->withMessage('Contractor Updated');
    }

    public function invoices($id)
    {
        $data = Tracking::with('invoices', 'invoices.taxRates')->find($id);


        foreach($data->invoices as $invoice)
        {
            $data['fees'] += $invoice->fees;
            $data['holdback'] += ($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0;
            $data['total'] += (($invoice->fees - (($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0)) * (1 + ($invoice->taxRates->rate / 100)));
            $data['owing'] += (($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0) * (1 + ($invoice->taxRates->rate / 100));
        }
        $data['subtotal'] = $data['fees'] - $data['holdback'];

        return view('invoices.invoice')
            ->withData($data);
    }

}
