<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use AFG\Priority;
use AFG\Http\Requests;
use Illuminate\Http\Request;

class ChartsController extends Controller
{

    public function chart(Request $request)
    {
        if(count($request->all())>0)
        {
            $this->validate($request, [
                'year'=> 'required',
                'priority' => 'required'
            ]);
        }

        $years  = Afg::groupBy('year')->lists('year');
        $priorities = Priority::groupBy('priority')->lists('priority');
        $selectedYears = $request->get('year') ?  $request->get('year') : $years;
        $selectedPriorities = $request->get('priority') ?  $request->get('priority') :  $priorities;

        foreach($years as $year)
        {
            $yearBoxes[$year]['year'] = $year;
            $yearBoxes[$year]['yearChecked'] = false;
            foreach($selectedYears as $selectedYear)
            {
                if($selectedYear == $year)
                {
                    $yearBoxes[$year]['yearChecked'] = true;
                }
            }
        }

        foreach($priorities as $priority)
        {
            $priorityBoxes[$priority]['priority'] = $priority;
            $priorityBoxes[$priority]['priorityChecked'] = false;
            foreach($selectedPriorities as $selectedPriority)
            {
                if($selectedPriority == $priority)
                {
                    $priorityBoxes[$priority]['priorityChecked'] = true;
                }
            }
        }

        $data = Afg::categoriesChart($selectedYears, $selectedPriorities);

        if(count($data) < 1)
        {
            return back()->withMessage('No data found from your selections, showing previous selections.');
        }

        foreach($data as $sets => $values)
        {
            foreach($values as $key => $value) {

                $collection[$sets][$key] = $value;
            }
        }

        foreach($collection as $set)
        {
            $categories[] = $set['category'];
            $estimates[] = $set['subTotal'];
        }

        $chart["chart"] = array("type" => "bar");
        $chart["title"] = array("text" => "CATEGORY");
        $chart["xAxis"] = array("categories" => $categories);
        $chart["yAxis"] = array("title" => array("text" => "total"));
        $chart['plotOptions'] = ['bar' => ['dataLabels' => ['enabled' => 'true']]];

        $chart["series"] = [
            array("name" => "Estimate", "data" => $estimates)
        ];

        return view('charts.categories', compact('chart', 'priorityBoxes', 'yearBoxes' ));

    }
}
