<?php

use App\Services\Route;

Route::make('/mbou4260/lesson/add', 'GET', 'LessonController', 'add');
Route::make('/mbou4260/lesson/start', 'POST', 'LessonController', 'start');
Route::make('/mbou4260/lesson/get', 'GET', 'LessonController', 'start');
Route::make('/mbou4260/lesson/ctest', 'GET', 'LessonController', 'cTest');
Route::make('/mbou4260/lesson/test', 'GET', 'LessonController', 'test');
Route::make('/mbou4260/lesson/teacher/get/work', 'GET', 'LessonController', 'getWork');
Route::make('/mbou4260/lesson/start/check', 'POST', 'LessonController', 'checkStart');
Route::make('/mbou4260/lesson/start/panel', 'POST', 'LessonController', 'showPanel');

