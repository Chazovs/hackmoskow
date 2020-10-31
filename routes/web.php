<?php

use App\Services\Route;

Route::make('/mbou4260/lesson/add', 'GET', 'LessonController', 'add');
Route::make('/mbou4260/lesson/start', 'POST', 'LessonController', 'start');
Route::make('/mbou4260/lesson/get', 'GET', 'LessonController', 'start');
Route::make('/mbou4260/lesson/get-js-test', 'GET', 'LessonController', 'getJsTest');
Route::make('/mbou4260/lesson/test', 'GET', 'LessonController', 'test');
<<<<<<< HEAD
Route::make('/mbou4260/lesson/users', 'GET', 'StudentsController', 'add');
Route::make('/mbou4260/lesson/teacher/get/work', 'GET', 'LessonController', 'getWork');

=======
Route::make('/mbou4260/lesson/users', 'GET', 'StudentsController', 'listUsers');
>>>>>>> 2
