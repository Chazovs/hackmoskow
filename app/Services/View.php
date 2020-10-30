<?php


namespace App\Services;


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
			$content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/view/' . $string . '.engine.php');
		}

		return $content;
	}
}