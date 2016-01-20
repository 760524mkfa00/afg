<?php

namespace AFG\Http\Controllers;


use AFG\Category;
use AFG\Http\Requests;
use Illuminate\Http\Request;
use AFG\Http\Controllers\Controller;

class ChartsController extends Controller
{

    public function chart()
    {
        $categories = Category::lists('category');
        $yourFirstChart["chart"] = array("type" => "bar");
        $yourFirstChart["title"] = array("text" => "CATEGORY");
        $yourFirstChart["xAxis"] = array("categories" => $categories);
        //$yourFirstChart["yAxis"] = array("title" => array("text" => "Fruit eaten"));

        $yourFirstChart["series"] = [
            array("name" => "Jane", "data" => [1,0,4,5,7,98])
        ];
        return view('charts.categories', compact('yourFirstChart'));
    }
}
