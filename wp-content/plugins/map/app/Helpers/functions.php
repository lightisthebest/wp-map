<?php

function view( $view = '', $params = []) {
	if ( empty( $view ) ) {
		return '';
	}
	$path = explode( '.', $view );
	$file = plugin_dir_path( __FILE__ ) . '../../resources/views';
	foreach ( $path as $item ) {
		$file .= "/$item";
	}
	$file .= '.php';

	if ( file_exists( $file ) ) {
		return include $file;
	}

	return '';
}

function response($view = null) {
	if (!is_null($view)) return view($view);

	return new \App\Model\Response();
}
