<?php 


$router->get('/', 'HomeController@index');
$router->get('/onze-voertuigen/details/show-car/{id}', 'OnzeVoertuigenController@showCarDetails');
$router->get('/onze-voertuigen/details/show-boat/{id}', 'OnzeVoertuigenController@showBoatDetails');
$router->get('/onze-voertuigen/details/show-bycicle/{id}', 'OnzeVoertuigenController@showBycicleDetails');
$router->get('/edit-auto/{id}', 'CarController@showEditCar');

$router->get('/onze-voertuigen', 'OnzeVoertuigenController@index');
$router->get('/onze-voertuigen/create-auto', 'CarController@showCreateCar');
$router->get('/onze-voertuigen/create-boot', 'BoatController@showCreateBoat');
$router->get('/onze-voertuigen/create-fiets', 'BycicleController@showCreateBycicle');
$router->get('/listing-car', 'CarController@showCarListing');



$router->put('/edit-auto/{id}', 'CarController@updateCar');


$router->post('/onze-voertuigen/create-auto', 'CarController@createCar');
$router->post('/auth/register/verhuurder', 'VerhuurderController@registerVerhuurder');

$router->delete('/listing-car/{id}', 'CarController@deleteCar');

$router->get('/auth/register/verhuurder', 'VerhuurderController@showRegisterForm');
$router->get('/auth/register/huurder', 'HuurderController@showRegisterForm');
$router->get('/auth/login', 'AuthController@showLoginForm');

// $router->get('/onze-voertuigen/create-boot', 'controllers/onze-voertuigen/create/create-boot.php');
// $router->get('/onze-voertuigen/create-fiets', 'controllers/onze-voertuigen/create/create-fiets.php');
// $router->get('/onderneming/create', 'controllers/onderneming/create-onderneming.php');
// $router->get('/about', 'controllers/about.php');
// $router->get('/contact', 'controllers/contact.php');




?>