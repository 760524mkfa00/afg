<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Services\Repositories\Afg\AfgRepository;
use Illuminate\Support\Facades\Input;

class ProjectsController extends Controller
{

    protected $project;




    public function __construct(AfgRepository $project)
    {
        $this->middleware('auth');

        $this->project = $project;
    }


    public function projects(Request $request)
    {

        $sortBy = $request->input('sortBy');
        $direction = $request->input('direction');
        $str = $request->input('str');
        $year = $request->input('year');

        return view('projects.projects')
            ->withData($this->project->getProjects(compact('sortBy', 'direction', 'str', 'year')));
    }

    public function projectsByYear($year)
    {
        //
    }

}
