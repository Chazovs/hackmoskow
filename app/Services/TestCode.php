<?php

namespace App\Services;

Class TestCode {
    const DATASET_PATH = '../lessons/tests/dataset.json';
    const DATASET_C_PATH = '../clessons/tests/dataset.json';
    const MAIN_C_FILE_PATH = '../cfiles/main.c';
    const TEMPLATE_C_FILE_PATH = '../cfiles/ctemplate';
    const ERROR_MSG = 'Ошибка выполнения программы';

    private $works;
    private $student;
    private $work;

    public function __construct(string $student, string $work = '')
    {
        $this->student = $student;
        $this->work = $work;
    }

    public function testPHP() {
        $taskPathTmp = '../lessons/users/' . $this->student . '/';
        $testResult = array();

        if ($this->getFileContent(self::DATASET_PATH)) {
            if (!empty($this->work)) {
                $taskPath = $taskPathTmp . $this->work . '.php';

                if ($this->includeFile($taskPath)) {
                    $result = call_user_func_array($this->work, $this->works[$this->work]['params']);
                    $testResult[$this->work]['result'] = $result == $this->works[$this->work]['result'];
                    $testResult[$this->work]['output'] = $result;
                } else {
                    $testResult[$this->work]['result'] = false;
                    $testResult[$this->work]['output'] = self::ERROR_MSG;
                }
            } else {
                foreach ($this->works as $work => $params) {
                    $taskPath = $taskPathTmp . $work . '.php';

                    if ($this->includeFile($taskPath)) {
                        $result = call_user_func_array($work, $params['params']);
                        $testResult[$work]['result'] = $result == $params['result'];
                        $testResult[$work]['output'] = $result;
                    } else {
                        $testResult[$work]['result'] = false;
                        $testResult[$work]['output'] = self::ERROR_MSG;
                    }
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
            if (!empty($this->work)) {
                $taskPath = $taskPathTmp . $this->work;

                if ($this->filePutContent($taskPath)) {
                    exec('cd ../cfiles/ && make compile');

                    $arg1 = $this->works[$this->work]['params'][0];
                    $arg2 = $this->works[$this->work]['params'][1];

                    exec("../cfiles/work $arg1 $arg2", $out);

                    $testResult[$this->work]['result'] = (float)$out[0] == $this->works[$this->work]['result'];
                    $testResult[$this->work]['output'] = (float)$out[0];
                } else {
                    $testResult[$this->work]['result'] = false;
                    $testResult[$this->work]['output'] = self::ERROR_MSG;
                }
            } else {
                foreach ($this->works as $work => $params) {
                    $taskPath = $taskPathTmp . $work;

                    if ($this->filePutContent($taskPath)) {
                        exec('cd ../cfiles/ && make compile');

                        $arg1 = $params['params'][0];
                        $arg2 = $params['params'][1];

                        exec("../cfiles/work $arg1 $arg2", $out);

                        $testResult[$work]['result'] = (float)$out[0] == $params['result'];
                        $testResult[$work]['output'] = (float)$out[0];
                    } else {
                        $testResult[$work]['result'] = false;
                        $testResult[$work]['output'] = self::ERROR_MSG;
                    }
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