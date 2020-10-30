<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Services\TestCode;
use App\Services\View;

class LessonController
{

	/**
	 *
	 */
	public function add(){

		return View::create('addlesson');
	}

	/**
	 * @return mixed
	 */
	public function start(){

		return View::create('x');
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
}