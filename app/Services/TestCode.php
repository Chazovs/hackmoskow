<?php

namespace App\Services;

Class TestCode {
    static public function testPHP(string $student, array $input, mixed $output) : bool {
        $path = '../testpath' . $student;
        require_once($path);

        $result = call_user_func_array('testcase', $input);

        if ($result == $output) {
            return true;
        }

        return false;
    }

    static public function testJS(string $student) : string {
        $path = '../testpath' . $student;
        require_once($path);


    }
}