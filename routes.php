<?php








$router->get('/', 'HomeController@index');

$router->get('/onze-voertuigen', 'OnzeVoertuigenController@index');
$router->get('/onze-voertuigen/details/show-car/{id}', 'OnzeVoertuigenController@showCarDetails');
$router->get('/onze-voertuigen/details/show-boat/{id}', 'OnzeVoertuigenController@showBoatDetails');
$router->get('/onze-voertuigen/details/show-bycicle/{id}', 'OnzeVoertuigenController@showBycicleDetails');
$router->get('/edit-auto/{id}', 'CarController@showEditCar');
$router->get('/edit-boot/{id}', 'BoatController@showEditBoat');
$router->get('/edit-onderneming/{id}', 'OndernemingController@showEditOnderneming');

$router->get('/create-auto', 'CarController@showCreateCar');
$router->get('/create-boot', 'BoatController@showCreateBoat');
$router->get('/create-fiets', 'BycicleController@showCreateBycicle');
$router->get('/onderneming/create', 'OndernemingController@showCreateOnderneming');
$router->get('/create-reservering/{id}', 'ReserveringController@showCreateReservering');
$router->get('/listing-vehicles', 'VoertuigenController@showMijnVoertuigen');
$router->get('/listing-reservering', 'ReserveringController@showMijnReserveringen'); // <--- hier bezig
$router->get('/listing-onderneming', 'OndernemingController@showOndernemingListing');


$router->get('/auth/register/verhuurder', 'VerhuurderController@showRegisterForm');
$router->get('/auth/register/huurder', 'HuurderController@showRegisterForm');
$router->get('/auth/register', 'AuthController@showRegisterKeuze');

$router->get('/onze-voertuigen/search', 'OnzeVoertuigenController@search');

$router->put('/annuleer-reservering/{id}', 'ReserveringController@annuleerReservering');
$router->put('/betaal-reservering/{id}', 'ReserveringController@betaalReservering');


$router->get('/auth/login', 'AuthController@showLoginForm');
$router->put('/edit-auto/{id}', 'CarController@updateCar');
$router->put('/edit-boot/{id}', 'BoatController@updateBoat');
$router->put('/edit-onderneming/{id}', 'OndernemingController@updateOnderneming');

$router->post('/create-auto', 'CarController@createCar');
$router->post('/create-boot', 'BoatController@createBoat');
$router->post('/onze-voertuigen/create-onderneming', 'OndernemingController@createOnderneming');
$router->post('/create-reservering', 'ReserveringController@createReservering');


$router->post('/auth/register/verhuurder', 'VerhuurderController@registerVerhuurder');
$router->post('/auth/register/huurder', 'HuurderController@registerHuurder'); 
$router->post('/auth/logout', 'AuthController@logout');

$router->post('/auth/login/verhuurder', 'AuthController@authenticateVerhuurder');

$router->delete('/listing-car/{id}', 'CarController@deleteCar');
$router->delete('/listing-boat/{id}', 'BoatController@deleteBoat');
$router->delete('/listing-onderneming/{id}', 'OndernemingController@deleteOnderneming');
$router->delete('/delete-reservering/{id}', 'ReserveringController@deleteReservering');



