<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use AFG\Http\Requests;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function projects()
    {

        $data = Afg::with(['categories', 'clients', 'locations', 'priorities', 'regions', 'managers'])->paginate(15);
        return view('projects.projects')
            ->withData($data);
    }
}
