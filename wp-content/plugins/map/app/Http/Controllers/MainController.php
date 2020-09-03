<?php

namespace App\Http\Controllers;

class MainController
{

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_shortcode('map', [$this, 'createMap']);
        add_option('markers');
    }

    /**
     *
     * @return string
     */
    public function createMap()
    {
        return view('map_shortcode');
    }
}