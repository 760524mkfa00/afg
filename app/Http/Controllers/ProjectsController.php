<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use AFG\Http\Requests;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    //


    public function projects()
    {

        $data = Afg::all();
        return view('projects.projects')
            ->withData($data);
    }
}
