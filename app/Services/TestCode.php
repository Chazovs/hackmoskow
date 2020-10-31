<?php

namespace App\Services;

use ErrorException;

class TestCode
{
	const DATASET_PATH     = '../lessons/tests/dataset.json';
	const MAIN_C_FILE_PATH = '../cfiles/main.c';

	private $works;
	private $student;

	public function __construct(string $student) {
		$this->student = $student;
	}

	public function testPHP() {
		$taskPathTmp = '../lessons/users/' . $this->student . '/';
		$testResult = [];

		if ($this->getFileContent(self::DATASET_PATH)) {
			foreach ($this->works as $work => $params) {
				$taskPath = $taskPathTmp . $work . '.php';

				if ($this->includeFile($taskPath)) {
					try {
						set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
							if (0 === error_reporting()) {
								return false;
							}

							throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
						});
						$result = call_user_func_array($work, $params['params']);
					} catch (ErrorException $exception) {

						return 'метод не найден в файле';
					}

					$testResult[$work] = $result == $params['result'];
				} else {
					return false;
				}
			}

			return json_encode($testResult);
		}

		return false;
	}

	public function testC() {
		exec("../cfiles/work 1 2", $out);

		$taskPathTmp = '../clessons/users/' . $this->student . '/';
		$testResult  = [];

		if ($this->getFileContent(self::DATASET_PATH)) {
			foreach ($this->works as $work => $params) {
				$taskPath = $taskPathTmp . $work;

				if ($this->filePutContent($taskPath)) {
					die();
					$result            = call_user_func_array($work, $params['params']);
					$testResult[$work] = $result == $params['result'];
				} else {
					return false;
				}
			}

			return json_encode($testResult);
		}

		return false;
	}

	private function includeFile(string $path): bool {
		if (file_exists($path) && is_readable($path)) {
			include_once $path;
		} else {
			return false;
		}

		return true;
	}

	private function getFileContent(string $path): bool {
		if (file_exists($path) && is_readable($path)) {
			$works       = json_decode(file_get_contents($path), true);
			$this->works = $works[$this->student];
		} else {
			return false;
		}

		return true;
	}

	private function filePutContent(string $path): bool {
		if (file_exists($path) && is_readable($path)) {
			$work = file_get_contents($path);
			file_put_contents(SELF::MAIN_C_FILE_PATH, $work, FILE_APPEND);
		} else {
			return false;
		}

		return true;
	}
}