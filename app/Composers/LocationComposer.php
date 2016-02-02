<?php
namespace AFG\Composers;

use AFG\Location;
use Illuminate\Contracts\View\View;


class LocationComposer {

    protected $location;

    public function __construct (Location $location)
    {

        $this->location = $location;

    }

    public function compose($view)
    {
        $view->with('locations', $this->location->listlocations());
    }

}