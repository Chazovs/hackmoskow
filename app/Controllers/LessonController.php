<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Services\StudentService;
use App\Services\TestCode;
use App\Services\View;
use RuntimeException;

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

			$legends = [];
			//im so sorry about this
			foreach ($lessonTasks as $task) {
				$legends[$task->variant] = $task->legend;

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
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/legend.php', json_encode($legends));
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json', json_encode($result));

		return $this->addLessonFolders($result);
	}

    /**
     * @return mixed
     */
    public function test(){
        $student = $_GET["student"];

        $testCode = new TestCode();
        var_dump($testCode->testPHP($student));
        die();

        return TestCode::testPHP($student);
    }

	/**
	 * @param array $result
	 * @return array
	 */
	private function addLessonFolders(array $result): array {

		foreach ($result as $student=>$data) {
			if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $student)) {
				if (!mkdir($concurrentDirectory = $_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $student, 0700) && !is_dir($concurrentDirectory)) {
					throw new RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
				}
				file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $student . '/index.php', '');
			}
		}

		return [];
	}
}