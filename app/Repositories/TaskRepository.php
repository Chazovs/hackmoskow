<?php


namespace App\Repositories;


use App\Models\User;

class TaskRepository
{

	public static function getAllByUser($userId) {

		return User::find($where);
	}
}