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

        $this->validate($request, [
            'year'=> 'required',
            'priority' => 'required'
        ]);

        $years  = Afg::groupBy('year')->lists('year');

        $priorities = Priority::groupBy('priority')->lists('priority');

        $selectedYears = $request->get('year') ?  $request->get('year') : $years;

        $selectedPriorities = $request->get('priority') ?  $request->get('priority') :  $priorities;

        $data = Afg::categoriesChart($selectedYears, $selectedPriorities);

        if(count($data) < 1)
        {
            return back()->withMessage('No Data');
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

        return view('charts.categories', compact('chart', 'years', 'selectedYears', 'selectedPriorities'));

    }
}
