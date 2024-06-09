<?php 


$router->get('/', 'HomeController@index');
$router->get('/onze-voertuigen', 'OnzeVoertuigenController@index');
$router->get('/onze-voertuigen/details/show-car', 'OnzeVoertuigenController@showCarDetails');
$router->get('/onze-voertuigen/details/show-boat', 'OnzeVoertuigenController@showBoatDetails');
$router->get('/onze-voertuigen/details/show-bycicle', 'OnzeVoertuigenController@showBycicleDetails');




$router->get('/onze-voertuigen/create-auto', 'CreateVehicleController@showCreateCar');
$router->get('/onze-voertuigen/create-boot', 'CreateVehicleController@showCreateBycicle');
$router->get('/onze-voertuigen/create-fiets', 'CreateVehicleController@showCreateBoat');

// $router->get('/onze-voertuigen/create-boot', 'controllers/onze-voertuigen/create/create-boot.php');
// $router->get('/onze-voertuigen/create-fiets', 'controllers/onze-voertuigen/create/create-fiets.php');
// $router->get('/onderneming/create', 'controllers/onderneming/create-onderneming.php');
// $router->get('/about', 'controllers/about.php');
// $router->get('/contact', 'controllers/contact.php');




?>