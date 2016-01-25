<?php

namespace AFG\Services\Tasks;

use AFG\Afg;
use AFG\Priority;
use Illuminate\Http\Request;
use AFG\Services\Exceptions\DataNotFoundException;

class chartsCategoriesTask
{

    protected $request;

    protected $categories;

    protected $drillDown;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function categoriesChart()
    {

        $this->buildDataSet();

        $categories = $this->categories;
        $dd = $this->drillDown;

        $chart["chart"] = array("type" => "column", 'borderColor' => '#ddd', 'borderWidth' => 1);
        $chart["title"] = array("text" => "Browse Improvement Areas", 'align' => 'left', 'x' => 30, 'y' => 30, 'margin' => 50);
        $chart["xAxis"] = array("type" => "category");
        $chart["yAxis"] = array("title" => array("text" => "Total Estimated Cost"));
        $chart['legend'] = array('enabled' => false);
        $chart['plotOptions'] = [
            'series' => [
                //"borderColor" => '#303030',
                'dataLabels' => ['overflow' => 'none', 'crop' => 'false', 'enabled' => 'true', "format" => "$ {point.y:,.2f}"],

            ]
        ];
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

        $chart['drilldown'] = [
            'drillUpButton' => [
                'relativeTo' => 'spacingBox',
                'position' => ['x' => -50, 'y' => 0]
            ],
            "series" => $dd
        ];

        return $chart;
    }

    protected function colours()
    {
        return ['#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01',
        '#B0DE09', '#04D215', '#0D8ECF', '#0D52D1', '#2A0CD0', '#8A0CCF', '#CD0D74', '#754DEB', '#DDDDDD', '#999999'];
    }

    protected function schoolData()
    {
        $selectedYears = $this->selectedYears();
        $selectedPriorities = $this->selectedPriorities();

        $drilldown = Afg::categoriesDrilldown($selectedYears, $selectedPriorities);

        foreach($drilldown as $sets => $values)
        {
            foreach($values as $key => $value) {

                $schools[$sets][$key] = $value;
            }
        }

        return $schools;

    }

    protected function categoryData()
    {

        $selectedYears = $this->selectedYears();
        $selectedPriorities = $this->selectedPriorities();

        $data = Afg::categoriesChart($selectedYears, $selectedPriorities);

        if(count($data) < 1)
        {
            throw new DataNotFoundException('The options you selected provided no results.');
        }

        foreach($data as $sets => $values)
        {
            foreach($values as $key => $value) {

                $collection[$sets][$key] = $value;
            }
        }

        return $collection;
    }


    protected function buildDataSet()
    {

        $collection = $this->categoryData();
        $schools = $this->schoolData();
        $colours = $this->colours();


        $i = 0;
        foreach($collection as $set)
        {
            $categories[$i]['name'] = (string)$set['category'];
            $categories[$i]['y'] = (double)$set['subTotal'];
            $categories[$i]['drilldown'] = $set['category'];
            $categories[$i]['color'] = $colours[$i];

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

            $this->categories = $categories;
            $this->drillDown = $dd;
    }


    protected function isChecked($data, $selected)
    {
        foreach($data as $line)
        {
            $lineBoxes[$line]['line'] = $line;
            $lineBoxes[$line]['lineChecked'] = false;
            foreach($selected as $select)
            {
                if($select == $line)
                {
                    $lineBoxes[$line]['lineChecked'] = true;
                }
            }
        }

        return $lineBoxes;
    }

    protected function years()
    {
        return Afg::groupBy('year')->lists('year');
    }

    protected function priorities()
    {
        return Priority::groupBy('priority')->lists('priority');
    }


    protected function selectedYears()
    {
        return $this->request->get('year') ?  $this->request->get('year') : $this->years();
    }

    protected function selectedPriorities()
    {
        return $this->request->get('priority') ?  $this->request->get('priority') : $this->priorities();
    }

    public function isYearChecked()
    {
        return $this->isChecked($this->years(), $this->selectedYears());
    }

    public function isPriorityChecked()
    {
        return $this->isChecked($this->priorities(), $this->selectedPriorities());
    }
}