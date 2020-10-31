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

        $path = sprintf("%s/lessons/tests/legend.json", $_SERVER['DOCUMENT_ROOT']);
        $legend = Student::file($path);

        $pathToDataset = sprintf("%s/lessons/tests/dataset.json", $_SERVER['DOCUMENT_ROOT']);
        $dataset = file_get_contents($pathToDataset);
        json_decode($dataset);

        $datasetToSend = [];
        foreach (json_decode($dataset) as $key=>$value) {

            if ($key == $_GET['user']) {
                foreach ($value as $i) {
                    array_push($datasetToSend,$value);
                    }
                }
            }


        return View::create('user', ['legend'=>$legend,'datasetToSend' => $datasetToSend]);
    }

    /**
     */
    public function saveToFile() {

        if (isset($_POST['send'])) {
            foreach ($_POST['send'] as $value) {
//                for ($i = 1;)

                $text = "<?php \n $value";
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lessons/users/Yra/work1.php', $text);
            }
        }


    }
}
