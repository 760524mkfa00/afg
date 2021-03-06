<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use Illuminate\Http\Request;
use AFG\Services\Tasks\chartsCategoriesTask;
use AFG\Http\Requests\chartsCategoriesRequest;
use AFG\Services\Exceptions\DataNotFoundException;

/**
 * Class ChartsController
 * @package AFG\Http\Controllers
 */
class ChartsController extends Controller
{


    /**
     * @var chartsCategoriesTask
     */
    protected $chartTask;


    /**
     * ChartsController constructor.
     * @param chartsCategoriesTask $chartTask
     */
    public function __construct(chartsCategoriesTask $chartTask)
    {
        $this->middleware('auth');
        $this->chartTask = $chartTask;
    }

    /**
     * @param chartsCategoriesRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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


    public function yearComparisonChart(chartsCategoriesRequest $request)
    {

        try
        {
            $yearBoxes = $this->chartTask->isYearChecked();
            $priorityBoxes = $this->chartTask->isPriorityChecked();
            $chart = $this->chartTask->categoriesByYearChart();
        }
        catch(DataNotFoundException $e)
        {
            return back()->withMessage($e->getMessage());
        }

        return view('charts.categoriesByYear', compact('chart', 'priorityBoxes', 'yearBoxes' ));
    }
}
