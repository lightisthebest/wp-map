<?php


namespace App\Http\Controllers;


use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

class ApiController
{
    /**
     * @param WP_REST_Request $request
     */
    public function getMapInfo(WP_REST_Request $request)
    {
        include app_path(MAP_INFO_FILE);
    }

    /**
     * @param WP_REST_Request $request
     */
    public function getTabs(WP_REST_Request $request)
    {
        include app_path(TABS_INFO_FILE);
    }

    /**
     * @param WP_REST_Request $request
     * @return WP_Error|WP_REST_Response
     */
    public function updateMapInfo(WP_REST_Request $request)
    {
        file_put_contents(app_path(MAP_INFO_FILE), json_encode($request->get_json_params()));
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @param WP_REST_Request $request
     * @return WP_Error|WP_REST_Response
     */
    public function updateTabsInfo(WP_REST_Request $request)
    {
        file_put_contents(app_path(TABS_INFO_FILE), json_encode($request->get_json_params()));
        return response()->json([
            'status' => 'ok'
        ]);
    }
}