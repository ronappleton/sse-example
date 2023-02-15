<?php

declare(strict_types=1);

namespace RonAppleton\SseExample\Helpers;

class Input
{
    public function get(string $key, $default = null): mixed
    {
        return $this->arrayGet($key, $_GET, $default);
    }

    public function post(string $key, $default = null): mixed
    {
        return $this->arrayGet($key, $_POST, $default);
    }

    public function server(string $key, $default = null): mixed
    {
        return $this->arrayGet($key, $_SERVER, $default);
    }

    public function request(string $key, $default = null): mixed
    {
        return $this->arrayGet($key, $_REQUEST, $default);
    }

    public function files(string $key, $default = null): mixed
    {
        return $this->arrayGet($key, $_FILES, $default);
    }

    private function arrayGet(string $key, array $data, mixed $default = null): mixed
    {
        if (empty($key) || !count($data)) {
            return $default;
        }

        if (str_contains($key, '.')) {
            $keys = explode('.', $key);

            foreach ($keys as $innerKey) {
                if (!array_key_exists($innerKey, $data)) {
                    return $default;
                }
                $data = $data[$innerKey];
            }

            return $data;
        }

        return array_key_exists($key, $data) ? $data[$key] : $default;
    }
}