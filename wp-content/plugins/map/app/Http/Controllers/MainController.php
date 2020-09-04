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
    }

    /**
     *
     * @param $args
     * @return string
     */
    public function createMap($args)
    {
        $params = shortcode_atts( array(
            'width' => 100,
        ), $args );

        if ($params['width'] > 100 || $params['width'] < 1)  {
            $params['width'] = 100;
        }
        return view('map_shortcode', $params);
    }
}