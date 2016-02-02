<?php
namespace AFG\Composers;

use AFG\Region;
use Illuminate\Contracts\View\View;


class RegionComposer {

    protected $region;

    public function __construct (Region $region)
    {

        $this->region = $region;

    }

    public function compose($view)
    {
        $view->with('regions', $this->region->listRegions());
    }

}