<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
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
        //var_dump($directoryis);


        return View::create('liststudent', ["directoryis" => "test"]);
    }

//    /**
//     * @return mixed
//     */
//    public function searchusers() {
// return ;
//    }
}
