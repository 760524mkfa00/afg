<?php

namespace AFG\Http\Controllers;

use AFG\Tracking;
use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Http\Controllers\Controller;
use AFG\Services\Tasks\trackingTasks;
use AFG\Http\Requests\TrackingRequest;
use AFG\Services\Repositories\Afg\AfgRepository;
use AFG\Services\Repositories\Tracking\TrackingRepository;

class TrackingController extends Controller
{

    protected $tracking;

    protected $project;

    protected $task;

    public function __construct(TrackingRepository $tracking, AfgRepository $project, trackingTasks $task)
    {
        $this->middleware('auth');
        $this->tracking = $tracking;
        $this->project = $project;
        $this->task = $task;
    }

    public function create($project)
    {
        return view('tracking.create')
            ->withProject($project);
    }

    public function store(TrackingRequest $request)
    {
        $project_id = $request->get('afg_id');

        $project = $this->project->getById($project_id);

        $project->tracking()->save(new Tracking($request->all()));

        return \Redirect::route('projects.balances', $project_id)->withMessage('Contractor Added');
    }

    public function edit($id, $project)
    {
        $data = $this->tracking->getById($id);
        return view('tracking.edit')
            ->withData($data)
            ->withProject($project);
    }

    public function update($id, TrackingRequest $request)
    {
        $project_id = $request->get('afg_id');
        $this->tracking->update($id, $request->all());

        return \Redirect::route('projects.balances', $project_id)->withMessage('Contractor Updated');
    }

    public function invoices($id)
    {
        $data = $this->task->invoiceTotals($id);

        return view('invoices.invoice')
            ->withData($data);
    }

}
