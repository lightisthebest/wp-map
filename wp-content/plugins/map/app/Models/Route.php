<?php


namespace App\Model;

use App\Helpers\Str;


/**
 * Class Route
 * @package App\Model
 * @method static get( string $uri, $function )
 * @method static post( string $uri, $function )
 */
class Route {

    public static $args = [];
    public static $index = 0;
    public static $index_in = 0;

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
		    $uri = Str::start($uri, '/');
			self::$args[self::$index]        = [
				'uri'      => $uri,
				'function' => $function,
				'method'   => strtoupper( $method ),
				'prefix'   => self::definePrefix(),
			];



            add_action( 'rest_api_init', function () {
                $arr = self::$args[self::$index_in];
				register_rest_route( 'my-map' . $arr['prefix'], $arr['uri'], [
						'methods'  => $arr['method'],
						'callback' => $arr['function']
					]
				);
				self::$index_in++;
			} );
            self::$index++;

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
		$arr = explode( DIRECTORY_SEPARATOR, $path );
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