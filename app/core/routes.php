<?php

use app\src\Route;
use app\src\Url;
use app\src\View;
use app\controllers\DashboardController;
use app\controllers\AuthController;
use app\controllers\Employee\ApplicationController;
use app\controllers\Admin\ApplicationStatusController;
use app\controllers\Admin\UserController;

Route::add('/', [DashboardController::class, 'dashboard']);
Route::add('applications/index', [ApplicationController::class, 'index']);
Route::add('applications/create', [ApplicationController::class, 'create']);
Route::add('applications/status/([1-9]*)/update', function ($id) {
	$controller = new ApplicationStatusController;
		
	return $controller->update($id);
});

Route::post('applications/store', [ApplicationController::class, 'store']);

Route::add('users/create', [UserController::class, 'create']);
Route::post('users/store', [UserController::class, 'store']);
Route::add('users/([1-9]*)/edit', function ($id) {
	$controller = new UserController;
		
	return $controller->edit($id);
});
Route::post('users/([1-9]*)/update', function ($id) {
	$controller = new UserController;
		
	return $controller->update($id);
});

Route::add('login', [AuthController::class, 'showLoginForm']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::run((new Url)->getUrl());

