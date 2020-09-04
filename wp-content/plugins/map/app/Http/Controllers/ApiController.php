<?php


namespace App\Http\Controllers;


use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

class ApiController
{
    /**
     * @return array
     */
    public function getFullMapInfo()
    {
        return [
            'map' => json_decode(file_get_contents(app_path(MAP_INFO_FILE)), true),
            'tabs' => json_decode(file_get_contents(app_path(TABS_INFO_FILE)), true),
            'categories' => json_decode(file_get_contents(app_path(CATEGORIES_INFO_FILE)), true),
        ];
    }

    /**
     * @return mixed
     */
    public function getMapInfo()
    {
        return json_decode(file_get_contents(app_path(MAP_INFO_FILE)), true);
    }

    /**
     * @return mixed
     */
    public function getTabs()
    {
        return [
            'tabs' => json_decode(file_get_contents(app_path(TABS_INFO_FILE)), true) ?? [],
            'categories' => json_decode(file_get_contents(app_path(CATEGORIES_INFO_FILE)), true),
        ];
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return json_decode(file_get_contents(app_path(CATEGORIES_INFO_FILE)), true) ?? [];
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

    /**
     * @param WP_REST_Request $request
     * @return WP_Error|WP_REST_Response
     */
    public function updateCategoriesInfo(WP_REST_Request $request)
    {
        file_put_contents(app_path(CATEGORIES_INFO_FILE), json_encode($request->get_json_params()));
        return response()->json([
            'status' => 'ok'
        ]);
    }
}