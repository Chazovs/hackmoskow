<?php

namespace App\Models;

class User extends AbstractModel
{
	public static function find($where) {
		$link = Connector::connect();
		return mysqli_query($link, "SELECT id,password,hash FROM users WHERE" . $where);
	}

	public function login()
    {
        $login = $_POST['login'];
        $query = mysqli_query($link, "SELECT id,password,hash FROM users WHERE login='" . $login . "'");
        $data = mysqli_fetch_assoc($query);


        if ($data['password'] === md5($_POST['password'])) {
            $_SESSION['hash'] = $data['hash'];
            $_SESSION['id'] = $data['id'];
        }
    }
    public function addUser(){


        $password = md5(trim($_POST['password']));
        $hash = md5($this->generateCode());

        $link->query("INSERT INTO users SET login='" . $login . "', password='" . $password . "',hash= '" . $hash . "'");

        $_SESSION['id'] = $link->insert_id;
        $_SESSION['hash'] = $hash;
    }
}