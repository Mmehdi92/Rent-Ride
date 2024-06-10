<?php 


$router->get('/', 'HomeController@index');
$router->get('/onze-voertuigen', 'OnzeVoertuigenController@index');
$router->get('/onze-voertuigen/details/show-car/{id}', 'OnzeVoertuigenController@showCarDetails');
$router->get('/onze-voertuigen/details/show-boat/{id}', 'OnzeVoertuigenController@showBoatDetails');
$router->get('/onze-voertuigen/details/show-bycicle/{id}', 'OnzeVoertuigenController@showBycicleDetails');




$router->get('/onze-voertuigen/create-auto', 'CarController@showCreateCar');
$router->get('/onze-voertuigen/create-boot', 'BycicleController@showCreateBycicle');
$router->get('/onze-voertuigen/create-fiets', 'BoatController@showCreateBoat');


$router->post('/onze-voertuigen/create-auto', 'CarController@createCar');

// $router->get('/onze-voertuigen/create-boot', 'controllers/onze-voertuigen/create/create-boot.php');
// $router->get('/onze-voertuigen/create-fiets', 'controllers/onze-voertuigen/create/create-fiets.php');
// $router->get('/onderneming/create', 'controllers/onderneming/create-onderneming.php');
// $router->get('/about', 'controllers/about.php');
// $router->get('/contact', 'controllers/contact.php');




?>