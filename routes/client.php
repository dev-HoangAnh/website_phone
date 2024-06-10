<?php

use Hoanh\WebsitePhone\Controllers\Client\AboutController;
use Hoanh\WebsitePhone\Controllers\Client\CartController;
use Hoanh\WebsitePhone\Controllers\Client\ContactController;
use Hoanh\WebsitePhone\Controllers\Client\HomeController;
use Hoanh\WebsitePhone\Controllers\Client\LoginController;
use Hoanh\WebsitePhone\Controllers\Client\OrderController;
use Hoanh\WebsitePhone\Controllers\Client\ProductController;

$router->get('/',                  HomeController::class       . '@index');
$router->get('/about',             AboutController::class      . '@index');

$router->get('/contact',           ContactController::class    . '@index');
$router->post('/contact/store',    ContactController::class    . '@store');

$router->get('/products',          ProductController::class    . '@index');
$router->get('/products/{id}',     ProductController::class    . '@detail');
$router->get('/product-show/{id}', ProductController::class    . '@productShow');

$router->get('/login',             LoginController::class    . '@showFormLogin');
$router->post('/handle-login',     LoginController::class    . '@login');
$router->get('/logout',            LoginController::class    . '@logout');

$router->get('cart/add',           CartController::class . '@add');
$router->get('cart/quantityInc',   CartController::class . '@quantityInc');
$router->get('cart/quantityDec',   CartController::class . '@quantityDec');
$router->get('cart/remove',        CartController::class . '@remove');
$router->get('cart/detail',        CartController::class . '@detail');

$router->post('order/checkout',     OrderController::class . '@checkout');
