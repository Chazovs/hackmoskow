<?php

namespace App\Controllers;



use App\Services\View;

class MainController
{
	/**
	 *
	 */
	public function index() {

		return View::create('index');
	}
}