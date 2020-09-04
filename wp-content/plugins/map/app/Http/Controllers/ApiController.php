<?php


namespace App\Http\Controllers;


use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

class ApiController
{
    /**
     * @param WP_REST_Request $request
     * @return array
     */
    public function getFullMapInfo(WP_REST_Request $request)
    {
        $cat_id = (int) $request->get_param('category');
        $file_tabs = json_decode(file_get_contents(app_path(TABS_INFO_FILE)), true);
        $tabs = [];
        if (!empty($cat_id)) {
            if (!empty($file_tabs) && is_array($file_tabs)) {
                foreach ($file_tabs as $tab) {
                    $places = [];
                    if (!empty($tab['places']) && is_array($tab['places'])) {
                        foreach ($tab['places'] as $place) {
                            if (($place['category'] ?? null) === $cat_id) {
                                $places[] = $place;
                            }
                        }
                    }
                    $tab['places'] = $places;
                    $tabs[] = $tab;
                }
            }
        } else {
            $tabs = $file_tabs;
        }


        return [
            'map' => json_decode(file_get_contents(app_path(MAP_INFO_FILE)), true),
            'tabs' => $tabs,
            'categories' => json_decode(file_get_contents(app_path(CATEGORIES_INFO_FILE)), true),
            'category' => $cat_id
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