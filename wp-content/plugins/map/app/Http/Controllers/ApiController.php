<?php


namespace App\Http\Controllers;


use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

class ApiController {
    public $map_path = '/wp-content/plugins/map/config/data/map.php';
    public $tabs_path = '/wp-content/plugins/map/config/data/tabs.php';

    /**
     * @param WP_REST_Request $request
     */
	public function getMapInfo( WP_REST_Request $request )  {
	    include realpath($_SERVER["DOCUMENT_ROOT"]) . $this->map_path;
    }

    /**
     * @param WP_REST_Request $request
     */
	public function getTabs(WP_REST_Request $request) {
        include realpath($_SERVER["DOCUMENT_ROOT"]) . $this->tabs_path;
	}

    /**
     * @param WP_REST_Request $request
     * @return WP_Error|WP_REST_Response
     */
	public function updateMapInfo(WP_REST_Request $request) {
	    file_put_contents(realpath($_SERVER["DOCUMENT_ROOT"]) . $this->map_path, json_encode($request->get_json_params()));
        return response()->json([
            'status' => 'ok'
        ]);
	}

    /**
     * @param WP_REST_Request $request
     * @return WP_Error|WP_REST_Response
     */
	public function updateTabsInfo(WP_REST_Request $request) {
        file_put_contents(realpath($_SERVER["DOCUMENT_ROOT"]) . $this->tabs_path, json_encode($request->get_json_params()));
        return response()->json([
            'status' => 'ok'
        ]);
	}
}