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

    public function edit($id)
    {
        $data = Tracking::findOrNew($id);
        return view('tracking.create')
            ->withData($data);
    }

    public function update($id, Request $request)
    {
        Tracking::find($id)->update($request->all());

//        return \Redirect::route('projects')->withMessage('Project Updated');
    }

}
