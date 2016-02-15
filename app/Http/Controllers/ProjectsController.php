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

        $data = Afg::with('tracking', 'tracking.invoices')->get();
        $total = [];

        foreach($data as $item)
        {
            $total[$item->id]['total'] = compact(0);
            foreach($item->tracking as $track)
            {
                foreach($track->invoices as $invoice)
                {
                    $total[$track->afg_id]['total'][] = $invoice->fees * (1 + ($invoice->taxRates->rate / 100));
                }
            }
            $total[$item->id]['total'] = array_sum($total[$item->id]['total']);
        }

        return view('projects.projects')
            ->withData($this->project->getProjects(compact('sortBy', 'direction', 'str', 'year')))
            ->withCommitted($total);
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
        $total = [];


        foreach($data->tracking as $track)
        {
            $total[$track->id]['fees'][] = 0;
            $total[$track->id]['additional'][] = 0;
            $total[$track->id]['total'][] = 0;
            foreach($track->invoices as $invoice)
            {
                if($invoice->additional)
                {
                    $total[$track->id]['additional'][] = $invoice->fees;
                } else {
                    $total[$track->id]['fees'][] = $invoice->fees;
                }
                $total[$track->id]['total'][] = $invoice->fees * (1 + ($invoice->taxRates->rate / 100));
            }

            $total[$track->id]['fees'] = array_sum($total[$track->id]['fees']);
            $total[$track->id]['additional'] = array_sum($total[$track->id]['additional']);
            $total[$track->id]['total'] = array_sum($total[$track->id]['total']);
        }

        foreach($total as $commit)
        {
            $data['committed'] += $commit['total'];
        }

        $data['surplus'] = $data->estimate - $data->committed;

        return view('projects.balances')
            ->withData($data)
            ->withTotal($total);
    }

}
