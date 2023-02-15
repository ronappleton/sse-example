<?php

declare(strict_types=1);

namespace RonAppleton\SseExample\Http\Controllers;

use RonAppleton\SseExample\Helpers\Input;

class BaseController
{
    protected Input $input;

    public function __construct()
    {
        $this->input = new Input();
    }
}