<?php

namespace App\Controllers;

/**
 * Class CommentController
 * @package App\Controllers
 */
class CommentController
{
	/**
	 *
	 */
	public function addComment(){

		$c ='';
		if (isset($_POST['lang']) && $_POST === 'cLang') {
		    $c = 'c';
		}


		if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/'.$c.'lessons/comments/') && !mkdir($concurrentDirectory = $_SERVER['DOCUMENT_ROOT'] . '/'.$c.'lessons/comments/') && !is_dir($concurrentDirectory)) {
			throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
		}

		if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/'.$c.'lessons/comments/'.$_POST['student'])
			&& !mkdir($concurrentDirectory = $_SERVER['DOCUMENT_ROOT'] . '/'.$c.'lessons/comments/'.$_POST['student']) && !is_dir($concurrentDirectory)) {
			throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
		}

		if ((bool) file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/'.$c.'lessons/comments/'.$_POST['student'].'/'.$_POST['work'], $_POST['comment'])) {
		    return 'комментарий добавлен';
		}

		return 'не удалось добавить комментарий';
	}
}