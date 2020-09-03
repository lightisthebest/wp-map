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

    $file = Str::finish($file, '.php');
    if (file_exists($file)) {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        try {
            require $file;
            return ob_get_clean();
        } catch (Throwable $e) {
            return '';
        }
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

function app_path($path = '')
{
    if (!empty($path)) $path = Str::start($path, '/');
    return realpath($_SERVER["DOCUMENT_ROOT"]) . $path;
}

function plugin_path($path = '')
{
    if (!empty($path)) $path = Str::start($path, '/');
    return app_path('wp-content/plugins/map' . $path);
}

function views_path($path = '')
{
    if (!empty($path)) $path = Str::start($path, '/');
    return plugin_path('resources/views' . $path);
}
