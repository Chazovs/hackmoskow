<?php


namespace App\Services;

/**
 * Class View
 * @package App\Services
 */
class View
{
	/**
	 * @param string $string
	 * @param array  $vars
	 * @return mixed
	 */
	public static function create(string $string, $vars = []) {
		$file = file_exists($_SERVER['DOCUMENT_ROOT'] . '/view/' . $string . '.engine.php');

		if ($file) {
			ob_start();
			extract($vars);
			require $_SERVER['DOCUMENT_ROOT'] . '/view/' . $string . '.engine.php';
			return ob_get_clean();
		}
	}
}
