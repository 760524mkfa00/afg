<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Http\Requests\ProjectRequest;
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


    public function create()
    {
        return view('projects.create');
    }

    public function store(ProjectRequest $request)
    {
        Afg::create($request->all());

        return \Redirect::route('projects')->withMessage('Project Added');
    }

    public function edit($id)
    {
        $data = Afg::findOrNew($id);
        return view('projects.edit')
            ->withData($data);
    }

    public function update($id, ProjectRequest $request)
    {
        Afg::find($id)->update($request->all());

        return \Redirect::route('projects')->withMessage('Project Updated');
    }

    public function balances($id)
    {
        $data = Afg::with('categories', 'clients', 'locations', 'priorities', 'regions', 'managers', 'tracking', 'tracking.invoices')->find($id);

//        $total = $data->toArray();
//        $test = [];
//        foreach($total['tracking'] as $track)
//        {
//            $tID = $track['id'];
//
//            foreach($track['invoices'] as $invoice)
//            {
//                if ( ! isset($test[$tID]['fees'])) {
//                $test[$tID]['fees'] = '0';
//                }
//                $test[$tID]['fees'] += $invoice['fees'];
//             }
////            // do the main totals here based on the totals from inner loop
//        }
        return view('projects.balances')
            ->withData($data);
    }

}
