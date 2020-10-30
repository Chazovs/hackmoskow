<?php

namespace App\Services;

Class TestCode {
    const DATASET_PATH = '../lessons/tests/dataset.php';

    private $works;

     public function testPHP(string $student) : bool {
        $taskPath = '../lessons/users/' . $student . '/index.php';

        if ($this->includeFile($taskPath) && $this->includeFile(self::DATASET_PATH)) {

            $works = $data[$student];

            var_dump(file_get_contents(self::DATASET_PATH));
            foreach ($works as $work => $params) {
                $result = call_user_func_array($work, $params['input']);
                var_dump($result);

                if ($result != $params['result']) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

     public function testJS(string $student) : string {
        $path = '../testpath' . $student;
        require_once($path);


    }

    private function includeFile(string $path) : bool {
        if (file_exists($path) && is_readable($path)) {
            include_once $path;
        } else {
            return false;
        }

        return true;
    }
}