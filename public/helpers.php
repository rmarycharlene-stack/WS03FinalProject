<?php

function basePath($path = '') {
    return __DIR__ . '/../' . $path;
}

function loadView($name, $data = []) {
    extract($data);
    require basePath("views/{$name}.view.php");
}

function loadPartials($name) {
   require basePath("views/partials/{$name}.view.php");
}

