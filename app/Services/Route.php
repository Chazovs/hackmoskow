<?php


namespace App\Services;


class Route
{
	/**
	 * @param string $path
	 * @param string $method
	 * @param string $controller
	 * @param string $func
	 */
	public static function make(string $path, string $method, string $controller, string $func) {
		global $ROUTES;
		$ROUTES[$method][] = [
			'path'       => $path,
			'controller' => $controller,
			'func'       => $func
		];
	}
}