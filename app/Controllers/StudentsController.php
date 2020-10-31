<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Services\student;
use App\Services\StudentService;
use App\Services\TestCode;
use App\Services\View;
use RuntimeException;

class StudentsController
{

    /**
     *
     */
    public function listUsers() {

        $path = sprintf("%s/lessons/users", $_SERVER['DOCUMENT_ROOT']);
        $directoryis = [];
        if ($handle = opendir($path)) {
            while (false !== ($directory = readdir($handle))) {
                if ($directory != "." && $directory != "..") {
                    array_push($directoryis, $directory);
                }
            }
            closedir($handle);
        }

        return View::create('liststudent', ["directoryis" => $directoryis]);
    }

    /**
     */
	public function viewUsers() {

		$path    = sprintf("%s/lessons/tests/legend.json", $_SERVER['DOCUMENT_ROOT']);
		$legend  = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/legend.json'), true);
		$dataset = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/tests/dataset.json'), true);

		$works = $dataset[$_GET['user']];
		foreach ($works as $key => $work) {
			if (isset($legend[$key])) {
				$result[] = [
					'work'   => $key,
					'legend' => $legend[$key],
					'user' => $_GET['user'],
				];
			}
		}
		return View::create('user', ['datasetToSend' => $result]);
	}

    /**
     */
    public function saveToFile() {
        trigger_error ("Cannot divide by zero", E_USER_ERROR);
		$text = "<?php \n".$_POST['comment'];
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/'.$_POST['user'].'/'.$_POST['work'].'.php', $text);
    }
}
