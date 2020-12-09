<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('featured', 'DefaultController');
Routing::get('registration', 'DefaultController');
Routing::get('tea', 'DefaultController');

Routing::post('returnConfirm', 'GetAjaxTextController');

Routing::post('login', 'SecurityController');

Routing::run($path);