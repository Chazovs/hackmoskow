<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Services\StudentService;
use App\Services\TestCode;
use App\Services\View;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use ZipArchive;

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
	public function test() {
		$student  = $_GET["student"];
		$testCode = new TestCode($student);
		var_dump($testCode->testPHP());
		die();

		return $testCode->testPHP();
	}

	/**
	 * @return mixed
	 */
	public function cTest() {
		$student  = $_GET["student"];
		$testCode = new TestCode($student);

		return $testCode->testC();
	}

    /**
     * @return mixed
     */
    public function testOnce() {
        $student  = $_GET["student"];
        $work = $_GET["work"];
        $testCode = new TestCode($student, $work);

        return $testCode->testPHP();
    }

    /**
     * @return mixed
     */
    public function cTestOnce() {
        $student  = $_GET["student"];
        $work = $_GET["work"];
        $testCode = new TestCode($student, $work);

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

	public function showPanel() {

		if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json')) {
			$contents = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json'));
		} else {
			return [];
		}

		if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json')) {
			$legends = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/legend.json'));
		} else {
			return [];
		}

		$legendsAr =[];

		foreach ($legends as $key => $legend) {
			$legendsAr[] = [
				'task'        => $key,
				'description' => $legend
			];
		}

		foreach ($contents as $key => $user) {
			$works        = array_slice(scandir($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $key), 2);
			$usersWorks[] = [
				'name'  => $key,
				'works' => $works
			];
		}

		return json_encode(
			[
			'dataset'=>	$usersWorks,
			'legenda'=>	$legendsAr
			]) ?? [];
	}

	/**
	 * @return false|string|string[]
	 */
	public function getWork() {
		$content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/' . $_GET['user'] . '/' . $_GET['work'], false, null, 5);
		$content = str_replace(['{', '}', ';'], ['{ <br>', ' <br>}', ';<br>'], $content);
		$content .= "<br><br><form action=\"/add/comment\" method='post'>
	<textarea name='comment'  cols='30' rows='10' placeholder='Оставить комментарий'></textarea><br>
	<input type='hidden' name='student' value='".$_GET['user']."'>
	<input type='hidden' name='work' value='".$_GET['work']."'>
<button>Отправить</button>
</form>";
		return $content;
	}

	/**
	 * @return bool
	 */
	public function checkStart() {
		if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json')) {
			$content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json');
			if (!empty($content) && $content !== []) {
				return 1;
			}

			return 0;
		}

		return 0;
	}

	/**
	 * @return bool
	 */
	public function downloadLesson()
	{

		$source = '/lessons/';
		$destination = './public/lesson.zip';

		if (!extension_loaded('zip') || !file_exists($source)) {
			return 0;
		}

		$zip = new ZipArchive();
		if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
			return 1;
		}

		$source = str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], realpath($source));

		if (is_dir($source) === true) {
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source),
				RecursiveIteratorIterator::SELF_FIRST);

			foreach ($files as $file) {
				$file = str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $file);

				if ($file === '.' || $file === '..' || empty($file) || $file === DIRECTORY_SEPARATOR) {
					continue;
				}
				if (in_array(substr($file, strrpos($file, DIRECTORY_SEPARATOR) + 1), array('.', '..'))) {
					continue;
				}

				$file = realpath($file);
				$file = str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $file);

				if (is_dir($file) === true) {
					$d = str_replace($source . DIRECTORY_SEPARATOR, '', $file);
					if (empty($d)) {
						continue;
					}
					$zip->addEmptyDir($d);
				} elseif (is_file($file) === true) {
					$zip->addFromString(str_replace($source . DIRECTORY_SEPARATOR, '', $file),
						file_get_contents($file));
				}
			}
		} elseif (is_file($source) === true) {
			$zip->addFromString(basename($source), file_get_contents($source));
		}

		return $zip->close();
	}
}