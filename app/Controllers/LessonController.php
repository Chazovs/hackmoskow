<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Services\StudentService;
use App\Services\TestCode;
use App\Services\View;

class LessonController
{

	/**
	 *
	 */
	public function add() {

		return View::create('addlesson');
	}

	/**
	 * @return mixed
	 */
	public function start() {
		if (isset($_POST['result'])) {
			$lessonTasks = json_decode($_POST['result']);
			$students    = StudentService::getStudents();

			//im so sorry about this
			foreach ($lessonTasks as $task) {

				foreach ($task->students as $student) {
					$result[$student][$task->variant] = [
						'result' => $task->output,
						'params' => [
							$task->firstParam,
							$task->secondParam,
						],
					];
				}
			}
		}

		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json', json_encode($result));

		return $this->addLessonFolders($result);
	}

	/**
	 * @return mixed
	 */
	public function test() {
		var_dump($_GET);
		return TestCode::testPHP('vasya', $input, $output);
	}

	/**
	 * @param array $result
	 * @return array
	 */
	private function addLessonFolders(array $result): array {
		return [];
	}
}