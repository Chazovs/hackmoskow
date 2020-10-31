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
    public function add() {

        return View::create('addstudent', []);
    }

//    /**
//     * @return mixed
//     */
//    public function start() {
// return ;
//    }
}
