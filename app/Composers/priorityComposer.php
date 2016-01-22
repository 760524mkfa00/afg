<?php
namespace AFG\Composers;

use AFG\Priority;
use Illuminate\Contracts\View\View;


class PriorityComposer {

    protected $priority;

    public function __construct (Priority $priority)
    {

        $this->priority = $priority;

    }

    public function compose($view)
    {
        $view->with('priorities', $this->priority->listPriorities());
    }

}