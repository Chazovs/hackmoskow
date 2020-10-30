<?php

namespace App\Controllers;

use App\Models\User;

class userController
{
    protected $user;

    public function login()
    {
        $user = $this->user->login();
    }
}
