<?php

namespace App\Http\Controllers;

class MainController {

	public function __construct() {
		$this->init();
	}

	public function init() {
		add_shortcode( 'map', [ $this, 'createMap' ] );
		add_option( 'markers' );
	}

	/**
	 * @param $index
	 *
	 * @return string]
	 */
	public function createMap( $index ) {
		$params  = shortcode_atts( array(
			'index' => 0,
		), $index );
		$markers = get_option( 'markers' );
		$markers = $markers[ $params['index'] ] ?? [];
		$vue = '';

		return view( 'map', compact( 'markers' ), ['map-vue' => $vue] );
	}
}