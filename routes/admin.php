<?php

use Hoanh\WebsitePhone\Controllers\Admin\CategoryController;
use Hoanh\WebsitePhone\Controllers\Admin\DashboardController;
use Hoanh\WebsitePhone\Controllers\Admin\UserController;

$router->before('GET|POST', '/admin/*.*', function () {
    if (!isset($_SESSION['user'])) {
        header('location: ' . url('login'));
        exit();
    }
});

$router->mount('/admin', function () use ($router) {

    $router->get('/', DashboardController::class . '@dashboard');

    // CRUD USER
    $router->mount('/users', function () use ($router) {
        $router->get('/', UserController::class . '@index');
        $router->get('/create', UserController::class . '@create');
        $router->post('/store', UserController::class . '@store');
        $router->get('/{id}/show', UserController::class . '@show');
        $router->get('/{id}/edit', UserController::class . '@edit');
        $router->post('/{id}/update', UserController::class . '@update');
        $router->get('/{id}/delete', UserController::class . '@delete');
    });

    // CRUD CATEGORY
    $router->mount('/categories', function () use ($router) {
        $router->get('/', CategoryController::class . '@index');
        $router->get('/create', CategoryController::class . '@create');
        $router->post('/store', CategoryController::class . '@store');
        $router->get('/{id}/show', CategoryController::class . '@show');
        $router->get('/{id}/edit', CategoryController::class . '@edit');
        $router->post('/{id}/update', CategoryController::class . '@update');
        $router->get('/{id}/delete', CategoryController::class . '@delete');
    });
});
