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
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/legend.json', json_encode($legends));
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json', json_encode($result));

		return $this->addLessonFolders($result ?? []);
	}

    /**
     * @return mixed
     */
    public function test(){
        $student = $_GET["student"];
        $testCode = new TestCode($student);

        return $testCode->testPHP();
    }

    /**
     * @return mixed
     */
    public function cTest(){
        $student = $_GET["student"];
        $testCode = new TestCode($student);

        return $testCode->testC();
    }

	/**
	 * @param array $result
	 * @return false|string
	 */
	private function addLessonFolders(array $result) {

		foreach ($result as $student => $data) {
			if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $student)) {
				if (!mkdir($concurrentDirectory = $_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $student, 0700) && !is_dir($concurrentDirectory)) {
					throw new RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
				}
				file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $student . '/index.php', '');
			}
		}
		$users = array_slice(scandir($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/'), 2);

		$usersWorks = [];
		foreach ($users as $user) {
			$works        = array_slice(scandir($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $user), 2);
			$usersWorks[] = [
				'name'  => $user,
				'works' => $works
			];
		}

		return json_encode($usersWorks) ?? '';
	}

	public function showPanel(){

		$contents = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json'));

		foreach ($contents as $key=>$user){
			$works        = array_slice(scandir($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $key), 2);
			$usersWorks[] = [
				'name'  =>  $key,
				'works' => $works
			];
		}

		return json_encode($usersWorks) ?? [];
	}

	/**
	 * @return false|string|string[]
	 */
	public function getWork() {
		$content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $_GET['user'] . '/' . $_GET['work'], false, null, 5);
		$content = str_replace(['{', '}', ';'], ['{ <br>', ' <br>}', ';<br>'], $content);
		return $content;
	}

	/**
	 * @return bool
	 */
	public function checkStart() {
		if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/legend.json')) {
			$content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/legend.json');
			if (!empty($content) && $content !== []) {
				return 1;
			}

			return 0;
		}

		return 0;
	}
}