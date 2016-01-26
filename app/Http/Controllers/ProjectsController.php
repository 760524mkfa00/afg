<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Services\Repositories\Afg\AfgRepository;

class ProjectsController extends Controller
{

    protected $project;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AfgRepository $project)
    {
        $this->middleware('auth');

        $this->project = $project;
    }


    public function projects()
    {

//        $data = Afg::with(['categories', 'clients', 'locations', 'priorities', 'regions', 'managers'])->paginate(15);



        return view('projects.projects')
            ->withData($this->project->getProjects());
    }

    public function projectsByYear($year)
    {
        $data = $this->project->getProjects();
        return view('projects.projects')
            ->withData($data);
    }
}
