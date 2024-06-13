<?php 


$router->get('/', 'HomeController@index');
$router->get('/onze-voertuigen/details/show-car/{id}', 'OnzeVoertuigenController@showCarDetails');
$router->get('/onze-voertuigen/details/show-boat/{id}', 'OnzeVoertuigenController@showBoatDetails');
$router->get('/onze-voertuigen/details/show-bycicle/{id}', 'OnzeVoertuigenController@showBycicleDetails');
$router->get('/edit-auto/{id}', 'CarController@showEditCar');
$router->get('/edit-onderneming/{id}', 'OndernemingController@showEditOnderneming');

$router->get('/onze-voertuigen', 'OnzeVoertuigenController@index');
$router->get('/onze-voertuigen/create-auto', 'CarController@showCreateCar');
$router->get('/onze-voertuigen/create-boot', 'BoatController@showCreateBoat');
$router->get('/onze-voertuigen/create-fiets', 'BycicleController@showCreateBycicle');
$router->get('/onderneming/create', 'OndernemingController@showCreateOnderneming');
$router->get('/listing-car', 'CarController@showCarListing');
$router->get('/listing-onderneming', 'OndernemingController@showOndernemingListing');



$router->put('/edit-auto/{id}', 'CarController@updateCar');
$router->put('/edit-onderneming/{id}', 'OndernemingController@updateOnderneming');

$router->post('/onze-voertuigen/create-auto', 'CarController@createCar');
$router->post('/onze-voertuigen/create-onderneming', 'OndernemingController@createOnderneming');

$router->post('/auth/register/verhuurder', 'VerhuurderController@registerVerhuurder');
$router->post('/auth/logout', 'AuthController@logout');

$router->post('/auth/login/verhuurder', 'AuthController@authenticateVerhuurder');

$router->delete('/listing-car/{id}', 'CarController@deleteCar' );
$router->delete('/listing-onderneming/{id}', 'OndernemingController@deleteOnderneming' );

$router->get('/auth/register/verhuurder', 'VerhuurderController@showRegisterForm');
$router->get('/auth/register/huurder', 'HuurderController@showRegisterForm');
$router->get('/auth/login', 'AuthController@showLoginForm');

// $router->get('/onze-voertuigen/create-boot', 'controllers/onze-voertuigen/create/create-boot.php');
// $router->get('/onze-voertuigen/create-fiets', 'controllers/onze-voertuigen/create/create-fiets.php');
// $router->get('/onderneming/create', 'controllers/onderneming/create-onderneming.php');
// $router->get('/about', 'controllers/about.php');
// $router->get('/contact', 'controllers/contact.php');




?>