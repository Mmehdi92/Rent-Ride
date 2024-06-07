<?php
require_once basePath('models/Car.php');
require_once basePath('models/Boat.php');
require_once basePath('models/Bycicle.php');


$listingAuto = Car::getMany();
$listingBoot = Boat::getMany();
$listingFiets = Bycicle::getMany();


loadView('onze-voertuigen/listings', [
    'listingFiets' => $listingFiets,
    'listingAuto' => $listingAuto,
    'listingBoot' => $listingBoot,
]);
