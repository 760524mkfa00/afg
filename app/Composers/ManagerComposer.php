<?php
namespace AFG\Composers;

use AFG\User;
use Illuminate\Contracts\View\View;


class ManagerComposer {

    protected $manager;

    public function __construct (User $manager)
    {

        $this->manager = $manager;

    }

    public function compose($view)
    {
        $view->with('managers', $this->manager->listManagers());
    }

}