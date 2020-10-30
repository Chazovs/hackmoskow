<?php

namespace App\Models;

/**
 * Class Task
 * @package App\Models
 */
class Task extends AbstractModel
{
	/**
	 * @var int $id
	 */
	public $id;

	/**
	 * @var string $description
	 */
	public $description;
	public $status;
	public $create_at;
	public $user_id;
}