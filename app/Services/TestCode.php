<?php

namespace App\Services;

Class TestCode {
    const DATASET_PATH = '../lessons/tests/dataset.json';
    const DATASET_C_PATH = '../clessons/tests/dataset.json';
    const MAIN_C_FILE_PATH = '../cfiles/main.c';
    const TEMPLATE_C_FILE_PATH = '../cfiles/ctemplate';

    private $works;
    private $student;

    public function __construct(string $student)
    {
        $this->student = $student;
    }

    public function testPHP() {
        $taskPathTmp = '../lessons/users/' . $this->student . '/';
        $testResult = array();

        if ($this->getFileContent(self::DATASET_PATH)) {
            foreach ($this->works as $work => $params) {
                $taskPath = $taskPathTmp . $work . '.php';

                if ($this->includeFile($taskPath)) {
                    $result = call_user_func_array($work, $params['params']);
                    $testResult[$work] = $result == $params['result'];
                } else {
                    return false;
                }
            }

            return json_encode($testResult);
        }

        return false;
    }

    public function testC() {
        $taskPathTmp = '../clessons/users/' . $this->student . '/';
        $testResult = array();

        if ($this->getFileContent(self::DATASET_C_PATH)) {
            foreach ($this->works as $work => $params) {
                $taskPath = $taskPathTmp . $work;

                if ($this->filePutContent($taskPath)) {
                    exec('cd ../cfiles/ && make compile');

                    $arg1 = $params['params'][0];
                    $arg2 = $params['params'][1];

                    exec("../cfiles/work $arg1 $arg2", $out);

                    $testResult[$work] = (float)$out[0] == $params['result'];
                } else {
                    return false;
                }
            }

            return json_encode($testResult);
        }

        return false;
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

    private function filePutContent(string $path) : bool {
        if (file_exists($path) && is_readable($path)) {
            $template = file_get_contents(self::TEMPLATE_C_FILE_PATH);
            $work = file_get_contents($path);
            file_put_contents(self::MAIN_C_FILE_PATH, $template);
            file_put_contents(self::MAIN_C_FILE_PATH, $work, FILE_APPEND);
        } else {
            return false;
        }

        return true;
    }
}