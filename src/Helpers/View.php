<?php

namespace RonAppleton\SseExample\Helpers;

class View
{
    public static function render(string $view, array $vars = []): false|string
    {
        $viewPath = dirname(__DIR__, 2) . '/views/';

        $view = str_replace('.', DIRECTORY_SEPARATOR, $view);

        if (count($vars)) {
            extract($vars);
        }

        ob_start();
        require $viewPath . $view . '.php';
        return ob_get_clean();
    }
}