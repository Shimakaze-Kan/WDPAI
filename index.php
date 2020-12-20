<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('featured', 'DefaultController');
Routing::get('tea', 'DefaultController');
Routing::get('recent', 'DefaultController');
Routing::get('add', 'DefaultController');
Routing::get('profile', 'ProfileController');

Routing::post('returnConfirm', 'GetAjaxTextController');
Routing::post('getCountriesData', 'GetAjaxTextController');
Routing::post('addTopic', 'TopicController');

Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('registration', 'SecurityController');

Routing::run($path);