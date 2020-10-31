<?php


namespace App\Core;


class Core
{

	public static function load() {
		global $ROUTES;

		$routeBlocks = $ROUTES[$_SERVER['REQUEST_METHOD']];

		foreach ($routeBlocks as $routeBlock) {
			if($routeBlock['path']  === strtok($_SERVER['REQUEST_URI'], '?')){
				$controllerName = 'App\Controllers\\' . $routeBlock['controller'];
				$controller = new $controllerName();
				$funcName = $routeBlock['func'];
				print_r($controller->$funcName());
			}
		}
	}
}
