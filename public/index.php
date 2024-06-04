<?php
require '../helper.php';

$routes = [
    '/' => 'controllers/home.php',
    '/onze-voertuigen' => 'controllers/onze-voertuigen/index.php',
    '/onze-voertuigen/create-auto' => 'controllers/onze-voertuigen/create/create-auto.php',
    '/onze-voertuigen/create-boot' => 'controllers/onze-voertuigen/create/create-boot.php',
    '/onze-voertuigen/create-fiets' => 'controllers/onze-voertuigen/create/create-fiets.php',
    '/onderneming/create' => 'controllers/onderneming/create-onderneming.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php',
    '404' => 'controllers/error/404.php'
];

$uri = $_SERVER['REQUEST_URI'];

if (array_key_exists($uri, $routes)) {
    require basePath($routes[$uri]);
} else {
    require basePath($routes['404']);
};
