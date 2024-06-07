<?php
require_once basePath('models/Car.php');
require_once basePath('models/Boat.php');
require_once basePath('models/Bycicle.php');

$config = require basePath('config/db.php');
$db = new Database($config);


//Dependency Injection  use 1 instance of Database class for all models
$listingAuto = Car::getMany($db);
$listingBoot = Boat::getMany($db);
$listingFiets = Bycicle::getMany($db);


loadView('onze-voertuigen/listings' , [
    'listingFiets' => $listingFiets,
    'listingAuto' => $listingAuto ,
    'listingBoot' => $listingBoot,
]);

?>