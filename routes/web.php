<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
   ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/job_tabel', [Controller\Site::class, 'job_tabel']) ->middleware('auth');
Route::add(['GET', 'POST'], '/employees', [Controller\Site::class, 'employees']) ->middleware('auth');
Route::add(['GET', 'POST'], '/addemployee', [Controller\Site::class, 'addemployee']) ->middleware('auth');
Route::add(['GET', 'POST'], '/adddepartament', [Controller\Site::class, 'adddepartament']) ->middleware('auth');
Route::add(['GET', 'POST'], '/adddiscipline', [Controller\Site::class, 'adddiscipline']) ->middleware('auth');
Route::add(['GET', 'POST'], '/disciplineemployees', [Controller\Site::class, 'disciplineemployees']) ->middleware('auth');



