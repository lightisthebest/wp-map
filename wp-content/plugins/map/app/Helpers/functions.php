<?php

use App\Helpers\Str;

function view($view = '', $params = [])
{
    if (empty($view)) {
        return '';
    }
    $path = explode('.', $view);
    $file = plugin_dir_path(__FILE__) . '../../resources/views';
    foreach ($path as $item) {
        $file .= "/$item";
    }
    $file .= '.php';

    if (file_exists($file)) {
        return file_get_contents($file);
//        include $file;
    }

    return '';
}

function response($view = null)
{
    if (!is_null($view)) return view($view);

    return new \App\Model\Response();
}


function config($string)
{
    $path = explode('.', $string);
    $first = array_shift($path);

    $dir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/wp-content/plugins/map/config';

    if (is_dir($dir . DIRECTORY_SEPARATOR . $first)) {
        $dir .= DIRECTORY_SEPARATOR . $first;
        $first = array_shift($path);
    }

    if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $first . '.php')) {
        $data = include $file;
        if (!empty($path) && is_array($data)) {
            foreach ($path as $item) {
                if (!empty($data[$item]))
                    $data = $data[$item];
                else $data = null;
            }
        }
        return $data;
    } else return null;
}

function app_path($path = '') {
    if (!empty($path)) $path = Str::start($path, '/');
    return realpath($_SERVER["DOCUMENT_ROOT"]) .$path;
}
