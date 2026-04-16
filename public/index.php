<?php
echo "hello";

require '../helpers.php';

require basePath('views/home.view.php');
loadView('home');

    $routes = [
        '/' => 'controllers/home.php',
        '/listings' => 'controllers/index.php',
        '/listings/create' => 'controllers/listings/create.php'
        '/404' => 'controllers/error/404.php'
    ];
