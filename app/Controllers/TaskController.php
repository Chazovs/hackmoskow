<?php

namespace App\Controllers;

use App\Repositories\TaskRepository;
use App\Services\View;

class TaskController
{

	public function list(){

		$tasks = TaskRepository::getAllByUser($_SESSION['userId']);

		return View::create('list', $tasks);
	}

}
