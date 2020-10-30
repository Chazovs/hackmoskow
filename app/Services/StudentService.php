<?php

namespace App\Services;


class StudentService
{

	public static function getStudents() {
		//TODO данные будут подтягиваться из БД
		return [ 'Yra', 'Sergey', 'Daniil' ];
	}
}