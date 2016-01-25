<?php

namespace AFG\Http\Controllers;

use Illuminate\Http\Request;
use AFG\Services\Tasks\chartsCategoriesTask;
use AFG\Http\Requests\chartsCategoriesRequest;
use AFG\Services\Exceptions\DataNotFoundException;

class ChartsController extends Controller
{

    protected $chartTask;

    public function __construct(chartsCategoriesTask $chartTask)
    {
        $this->chartTask = $chartTask;
    }

    public function chart(chartsCategoriesRequest $request)
    {
        try
        {
            $yearBoxes = $this->chartTask->isYearChecked();
            $priorityBoxes = $this->chartTask->isPriorityChecked();
            $chart = $this->chartTask->categoriesChart();
        }
        catch(DataNotFoundException $e)
        {
            return back()->withMessage($e->getMessage());
        }
        return view('charts.categories', compact('chart', 'priorityBoxes', 'yearBoxes' ));
    }
}
