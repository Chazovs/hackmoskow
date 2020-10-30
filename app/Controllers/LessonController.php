<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
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

}