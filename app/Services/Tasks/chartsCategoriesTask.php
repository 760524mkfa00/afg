<?php

namespace AFG\Services\Tasks;

use AFG\Afg;
use AFG\Priority;
use AFG\Category;
use Illuminate\Http\Request;
use AFG\Services\Exceptions\DataNotFoundException;

/**
 * Class chartsCategoriesTask
 * @package AFG\Services\Tasks
 */
class chartsCategoriesTask
{

    /**
     * Store the request data
     * @var Request
     */
    protected $request;

    /**
     * Store main series for chart
     * @var
     */
    protected $categories;

    /**
     * Store the drill down information
     * @var
     */
    protected $drillDown;

    /**
     * Inject the post request
     * chartsCategoriesTask constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Builds up the chart layout title and settings
     * @return mixed
     */
    public function categoriesChart()
    {
        // Call the data set for the series and drill down
        $this->buildDataSet();

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
                "data" => $this->categories)
        );

        $chart['drilldown'] = [
            'drillUpButton' => [
                'relativeTo' => 'spacingBox',
                'position' => ['x' => -50, 'y' => 0]
            ],
            "series" => $this->drillDown
        ];

        return $chart;
    }

    /**
     * An array of colours for the chart bars
     * @return array
     */
    protected function colours()
    {
        return ['#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01',
        '#B0DE09', '#04D215', '#0D8ECF', '#0D52D1', '#2A0CD0', '#8A0CCF', '#CD0D74', '#754DEB', '#DDDDDD', '#999999'];
    }

    /**
     * get the drill down data and convert it to an array
     * @return mixed
     */
    protected function schoolData()
    {
        return json_decode(json_encode(Afg::categoriesDrilldown($this->selectedYears(), $this->selectedPriorities())), true);
    }

    /**
     * get the category data, convert it to an array
     * check it has data and throw an exception if it does not
     * @return mixed
     * @throws DataNotFoundException
     */
    protected function categoryData()
    {

        $data = json_decode(json_encode(Afg::categoriesChart($this->selectedYears(), $this->selectedPriorities())), true);

        if(count($data) < 1)
        {
            throw new DataNotFoundException('The options you selected provided no results.');
        }

        return $data;
    }

    /**
     * get the category data, convert it to an array
     * check it has data and throw an exception if it does not
     * @return mixed
     * @throws DataNotFoundException
     */
    protected function categoryYearData()
    {

        $data = json_decode(json_encode(Afg::categoriesByYearChart($this->selectedYears(), $this->selectedPriorities())), true);

        if(count($data) < 1)
        {
            throw new DataNotFoundException('The options you selected provided no results.');
        }

        return $data;
    }


    /**
     * takes the data and organises it to an array set for the chart categories and drill downs can reproduce in chart format
     * @throws DataNotFoundException
     */
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


    /**
     * check if an option was checked and pass that back to the checkboxes so the user can see what options they selected.
     * @param $data
     * @param $selected
     * @return mixed
     */
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

    /**
     * Get a list of years currently used from the afg table
     * @return mixed
     */
    protected function years()
    {
        return Afg::groupBy('year')->lists('year');
    }

    /**
     * get the list of priorities
     * @return mixed
     */
    protected function priorities()
    {
        return Priority::groupBy('priority')->lists('priority');
    }

    /**
     * get the list of priorities
     * @return mixed
     */
    protected function categories()
    {
        return Category::groupBy('category')->orderBy('category')->lists('category');
    }


    /**
     * get the years that were checked
     * @return mixed
     */
    protected function selectedYears()
    {
        return $this->request->get('year') ?  $this->request->get('year') : $this->years();
    }

    /**
     * get the selected priorities
     * @return mixed
     */
    protected function selectedPriorities()
    {
        return $this->request->get('priority') ?  $this->request->get('priority') : $this->priorities();
    }

    /**
     * check if a year is checked
     * @return mixed
     */
    public function isYearChecked()
    {
        return $this->isChecked($this->years(), $this->selectedYears());
    }

    /**
     * check if a priority is checked
     * @return mixed
     */
    public function isPriorityChecked()
    {
        return $this->isChecked($this->priorities(), $this->selectedPriorities());
    }


    /**
     * Builds up the chart layout title and settings
     * @return mixed
     */
    public function categoriesByYearChart()
    {
        // Call the data set for the series and drill down
        $this->buildYearDataSet();

        $chart["chart"] = array("type" => "column", 'borderColor' => '#ddd', 'borderWidth' => 1);
        $chart["title"] = array("text" => "Browse Categories By Year", 'align' => 'left', 'x' => 30, 'y' => 30, 'margin' => 50);
        $chart["xAxis"] = [
            "categories" => $this->categories(),
            "crosshair" => true
        ];
        $chart["yAxis"] = [
            'min' => 0,
            "title" => [
                "text" => "Total Estimated Cost",
                'align' => 'high'
            ],
            'labels' => [
                'overflow' => 'justify'
            ]
        ];
        $chart['legend'] = array('enabled' => true);
        $chart['plotOptions'] = [
            'bar' => [
                //"borderColor" => '#303030',
                'dataLabels' => ['overflow' => 'none', 'crop' => 'false', 'enabled' => 'true', "format" => "$ {point.y:,.2f}"],

            ]
        ];
        $chart['credits'] = array('enabled' => false);
        $chart['tooltip'] = [
            'headerFormat' => '<span style="font-size:11px">{series.name}</span><br>',
            'pointFormat' => '<span style="color:{point.color}">{point.name}</span>: <b>${point.y:.2f}</b> of total<br/>'
        ];
        $chart["series"] = $this->categories;

        return $chart;
    }

    /**
     * takes the data and organises it to an array set for the chart categories and drill downs can reproduce in chart format
     * @throws DataNotFoundException
     */
    protected function buildYearDataSet()
    {

        $categories = $this->categories();
        $collections = $this->categoryYearData();
        $years = $this->selectedYears();

        foreach($collections as $collection)
        {
                $cat[$collection['year']]['data'][$collection['category']] = $collection['subTotal'];
        }

        $i = 0;
        foreach($cat as $key => $value)
        {
//            dd($value);
            $data[$i]['name'] = (string)$key;
            foreach($value as $key => $category)
            {

                for($i = 0; $i < count($this->categories()); $i++ )
                {

                    foreach ($category as $keys => $cats)
                    {
                        $data[$i]['data'][] = $cats;
                        //                $data[$i]['data'][] = array_intersect($this->categories(), $keys);
                    }
                }
            }
            $i++;
        }


        dd($data);
        $this->categories = $data;

    }
}