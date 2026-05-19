<?php

class Router
{
    public function route($uri, $method)
    {
        global $routes;

        $path = parse_url($uri, PHP_URL_PATH);

        if (!isset($routes) || !is_array($routes)) {
            http_response_code(500);
            echo 'No routes configured.';
            return;
        }

        if (isset($routes[$method][$path])) {
            $handler = $routes[$method][$path];
            if (is_callable($handler)) {
                call_user_func($handler);
                return;
            }
            if (is_string($handler) && file_exists($handler)) {
                require $handler;
                return;
            }
            echo $handler;
            return;
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}
