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


        $drilldown = Afg::categoriesDrilldown($selectedYears, $selectedPriorities);

        foreach($drilldown as $sets => $values)
        {
            foreach($values as $key => $value) {

                $schools[$sets][$key] = $value;
            }
        }


        foreach($data as $sets => $values)
        {
            foreach($values as $key => $value) {

                $collection[$sets][$key] = $value;
            }
        }


        $i = 0;
        foreach($collection as $set)
        {
            $labels[] = $set['category'];
            $categories[$i]['name'] = (string)$set['category'];
            $categories[$i]['y'] = (double)$set['subTotal'];
            $categories[$i]['drilldown'] = $set['category'];

            $dd[$i]['name'] = $set['category'];
            $dd[$i]['id'] = $set['category'];
            $dd[$i]['data'] = [];



            foreach($schools as $value)
            {
                if($value['category'] == $dd[$i]['name'])
                {
                    $dd[$i]['data'][] = [$value['location'] , (float)$value['estimate']];
                }
            }

            $i++;
        }

        $chart["chart"] = array("type" => "column");
        $chart["title"] = array("text" => "Browse Categories");
        $chart["xAxis"] = array("type" => "category");
        $chart["yAxis"] = array("title" => array("text" => "Total Estimated Cost"));
        $chart['legend'] = array('enabled' => false);
        $chart['plotOptions'] = ['column' => ["borderWidth" => 0,'dataLabels' => ['overflow' => 'none', 'crop' => 'false', 'enabled' => 'true', "format" => "{point.y:.2f}"]]];
        $chart['credits'] = array('enabled' => false);
        $chart['tooltip'] = [
            'headerFormat' => '<span style="font-size:11px">{series.name}</span><br>',
            'pointFormat' => '<span style="color:{point.color}">{point.name}</span>: <b>${point.y:.2f}</b> of total<br/>'
        ];
        $chart["series"] = array(
            array("name" => "Categories",
                "colourByPoint" => true,
                "data" => $categories)
        );

        $chart['drilldown'] = ["series" => $dd];


        return view('charts.categories', compact('chart', 'priorityBoxes', 'yearBoxes' ));

//        return \Response::json($chart);
    }
}
