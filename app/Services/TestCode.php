<?php

namespace App\Services;

Class TestCode {
    const DATASET_PATH = '../lessons/tests/dataset.json';

    private $works;
    private $student;

    public function __construct(string $student)
    {
        $this->student = $student;
    }

    public function testPHP() : bool {
        $taskPathTmp = '../lessons/users/' . $this->student . '/';

        if ($this->getFileContent(self::DATASET_PATH)) {
            foreach ($this->works as $work => $params) {
                $taskPath = $taskPathTmp . $work . '.php';

                if ($this->includeFile($taskPath)) {
                    $result = call_user_func_array($work, $params['params']);

                    if ($result != $params['result']) {
                        return false;
                    }
                } else {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

     public function testJS() : string {
        $path = '../testpath';
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

    private function getFileContent(string $path) : bool {
        if (file_exists($path) && is_readable($path)) {
            $works = json_decode(file_get_contents($path), true);
            $this->works = $works[$this->student];
        } else {
            return false;
        }

        return true;
    }
}