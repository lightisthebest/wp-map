<?php

use App\Model\Route;

/**
 * @uses \App\Http\Controllers\TestController::do()
 */
Route::get('do', 'TestController@do');

/**
 * @uses \App\Http\Controllers\ApiController::getMapInfo()
 */
Route::get('map', 'ApiController@getMapInfo');

/**
 * @uses \App\Http\Controllers\ApiController::getTabs()
 */
Route::get('tabs', 'ApiController@getTabs');

/**
 * @uses \App\Http\Controllers\ApiController::getFullMapInfo()
 */
Route::get('full-map', 'ApiController@getFullMapInfo');

/**
 * @uses \App\Http\Controllers\ApiController::updateMapInfo()
 */
Route::post('map', 'ApiController@updateMapInfo');

/**
 * @uses \App\Http\Controllers\ApiController::updateTabsInfo()
 */
Route::post('/tabs', 'ApiController@updateTabsInfo');
