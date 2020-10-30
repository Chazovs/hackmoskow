<?php


namespace App\Services;


class View
{
	/**
	 * @param string $string
	 * @param array  $tasks
	 * @return mixed
	 */
	public static function create(string $string, $tasks = []) {
		$file = file_exists($_SERVER['DOCUMENT_ROOT'] . '/view/' . $string . '.engine.php');

		if ($file) {
			$content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/view/' . $string . '.engine.php');
		}

		return $content;
	}
}