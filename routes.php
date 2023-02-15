<?php

declare(strict_types=1);

use RonAppleton\SseExample\Services\Router;

Router::addRoute('/', 'get', 'HomeController@index');
Router::addRoute('/orders', 'get', 'OrderController@index');
Router::addRoute('/order/{order}', 'get', 'OrderController@edit');
Router::addRoute('/order/update', 'post', 'OrderController@update');