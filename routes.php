<?php 
// return [
//     '/' => 'controllers/home.php',
//     '/onze-voertuigen' => 'controllers/onze-voertuigen/index.php',
//     '/onze-voertuigen/create-auto' => 'controllers/onze-voertuigen/create/create-auto.php',
//     '/onze-voertuigen/create-boot' => 'controllers/onze-voertuigen/create/create-boot.php',
//     '/onze-voertuigen/create-fiets' => 'controllers/onze-voertuigen/create/create-fiets.php',
//     '/onderneming/create' => 'controllers/onderneming/create-onderneming.php',
//     '/about' => 'controllers/about.php',
//     '/contact' => 'controllers/contact.php',
//     '404' => 'controllers/error/404.php'
// ];


$router->get('/', 'controllers/home.php');
$router->get('/onze-voertuigen', 'controllers/onze-voertuigen/index.php');
$router->get('/onze-voertuigen/create-auto', 'controllers/onze-voertuigen/create/create-auto.php');
$router->get('/onze-voertuigen/create-boot', 'controllers/onze-voertuigen/create/create-boot.php');
$router->get('/onze-voertuigen/create-fiets', 'controllers/onze-voertuigen/create/create-fiets.php');
$router->get('/onderneming/create', 'controllers/onderneming/create-onderneming.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

?>