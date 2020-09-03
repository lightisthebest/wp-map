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
     * @return string]
     */
    public function createMap()
    {
        $map = json_decode(file_get_contents(app_path(MAP_INFO_FILE)), true);
        $tabs = json_decode(file_get_contents(app_path(TABS_INFO_FILE)), true);

        return view('map_shortcode', compact('map', 'tabs'));
    }
}