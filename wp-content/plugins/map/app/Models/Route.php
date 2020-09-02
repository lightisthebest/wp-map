<?php


namespace App\Model;


/**
 * Class Route
 * @package App\Model
 * @method static get( string $uri, $function )
 * @method static post( string $uri, $function )
 */
class Route {

	/**
	 * @param $name
	 * @param $args
	 *
	 * @return bool
	 */
	public static function __callStatic( $name, $args ) {
		return self::registerRoute( $name, ... $args );
	}


	/**
	 * @param $method
	 * @param $uri
	 * @param $function
	 *
	 * @return bool
	 */
	private static function registerRoute( string $method, string $uri, $function ) {

		if ( ! in_array( strtoupper( $method ), [ 'GET', "POST" ] ) ) {
			return false;
		}

		if ( is_string( $function ) ) {
			$arr = explode( '@', $function );
			if ( count( $arr ) === 2 ) {
				$class_name = '\App\Http\Controllers\\' . $arr[0];
				$object     = new $class_name();
				if ( method_exists( $object, $arr[1] ) ) {
					$function = [ $object, $arr[1] ];
				}
			}
		}

		if ( ! empty( $uri ) && ! empty( $function ) && is_callable( $function ) ) {
			global $arr1234;
			$arr1234        = [
				'uri'      => $uri,
				'function' => $function,
				'method'   => strtoupper( $method ),
				'prefix'   => self::definePrefix(),
			];



			add_filter( 'custom_route', function ($prefix, $uri, $method, $function) { //'rest_api_init
				global $arr1234;
				register_rest_route( 'my-map' . $arr1234['prefix'], $arr1234['uri'], [
						'methods'  => $arr1234['method'],
						'callback' => $arr1234['function']
					]
				);
			}, 10, 4 );

			apply_filters('custom_route');

			return true;
		}

		return false;
	}

	/**
	 * @return string
	 */
	private static function definePrefix(): string {

		foreach ( debug_backtrace() as $arr ) {
			$file = self::defineFile( $arr['file'] ?? 'Route' );
			if ( $file !== 'Route' ) {
				return '/' . $file;
			}
		}

		return '';
	}

	/**
	 * @param $path
	 *
	 * @return mixed|string
	 */
	private static function defineFile( $path ) {
		$arr = explode( '/', $path );
		if ( is_array( $arr ) ) {
			$file = array_pop( $arr );
			$arr  = explode( '.', $file );
			if ( is_array( $arr ) ) {
				return $arr[0];
			}
		}

		return 'Route';
	}

}