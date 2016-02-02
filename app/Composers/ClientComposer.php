<?php
namespace AFG\Composers;

use AFG\Client;
use Illuminate\Contracts\View\View;


class ClientComposer {

    protected $client;

    public function __construct (Client $client)
    {

        $this->client = $client;

    }

    public function compose($view)
    {
        $view->with('clients', $this->client->listclients());
    }

}