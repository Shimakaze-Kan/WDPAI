<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('add', 'DefaultController');

Routing::get('profile', 'UserController');

Routing::get('recent', 'TopicController');
Routing::get('featured', 'TopicController');
Routing::get('tea', 'TopicController');

Routing::post('updateCountryData', 'TopicController');
Routing::post('getCountriesData', 'TopicController');
Routing::post('addTopic', 'TopicController');
Routing::post('deleteTopic', 'TopicController');
Routing::post('rateTopic', 'TopicController');

Routing::post('banUser', 'UserController');
Routing::post('unbanUser', 'UserController');
Routing::post('updateLastActivity', 'UserController');
Routing::post('updateUsersDetails', 'UserController');

Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('registration', 'SecurityController');

Routing::run($path);