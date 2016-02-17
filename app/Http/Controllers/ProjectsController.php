<?php

namespace AFG\Http\Controllers;

use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Services\Tasks\projectsTasks;
use AFG\Http\Requests\ProjectRequest;
use AFG\Services\Repositories\Afg\AfgRepository;

class ProjectsController extends Controller
{

    protected $project;

    protected $task;


    public function __construct(AfgRepository $project, projectsTasks $task)
    {
        $this->middleware('auth');

        $this->project = $project;
        $this->task = $task;
    }


    public function projects(Request $request)
    {

        $sortData = $this->task->sortData($request);

        return view('projects.projects')
            ->withData($sortData)
            ->withCommitted($this->task->calculateTotals());

    }


    public function create()
    {
        return view('projects.create');
    }

    public function store(ProjectRequest $request)
    {

        $this->project->create($request->all());

        return \Redirect::route('projects')->withMessage('Project Added');
    }

    public function edit($id)
    {
        $data = $this->project->getById($id);

        return view('projects.edit')
            ->withData($data);
    }

    public function update($id, ProjectRequest $request)
    {
        $this->project->update($id,$request->all());

        return \Redirect::route('projects')->withMessage('Project Updated');
    }

    public function balances($id)
    {
        $balance = $this->task->allData($id);
        $data = $balance['data'];
        $total = $balance['total'];

        return view('projects.balances')
            ->withData($data)
            ->withTotal($total);
    }

}
