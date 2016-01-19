<?php

namespace AFG\Http\Controllers;

use AFG\Afg;
use AFG\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Afg::groupYear();
        foreach($data as $sets => $values) {
            foreach($values as $key => $value) {
                $collection[$sets][$key] = $value;
            }
        }

        $group = [];

        foreach ( $collection as $value ) {
            $group[$value['year']][] = $value;
        }



        $total = [];
        $runningTotal = 0;
        foreach ($group as $key => $value)
        {
            foreach ($value as $line)
            {
                $runningTotal = $runningTotal + $line['subTotal'];
            }
            $total[$key] = $runningTotal;
            $runningTotal = 0;
        }
//        dd($total);
        return view('home')
            ->withData($group)
            ->withTotal($total);
    }
}
