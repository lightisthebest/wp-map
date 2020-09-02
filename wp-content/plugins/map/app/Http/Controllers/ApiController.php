<?php


namespace App\Http\Controllers;


use WP_REST_Request;

class ApiController {

	/**
	 * @return \WP_Error|\WP_REST_Response
	 */
	public function getMapInfo( WP_REST_Request $request ) {
		return response()->json([
			'status' => 'ok'
		]);
	}

	public function getTabs() {

	}

	public function updateMapInfo() {

	}

	public function updateTabs() {

	}
}