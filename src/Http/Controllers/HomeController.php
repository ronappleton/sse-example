<?php

declare(strict_types=1);

namespace RonAppleton\SseExample\Http\Controllers;

use RonAppleton\SseExample\Helpers\View;

class HomeController extends BaseController
{
    public function index(): false|string
    {
        return View::render('homepage.index');
    }
}