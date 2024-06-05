<?php
// require_once basePath('models/Car.php');
// $config = require basePath('config/db.php');

// $db = new Database($config);
// $listingFiets = $db->query('SELECT * FROM fiets INNER JOIN voertuig on voertuig.VoertuigId = fiets.FietsId LIMIT 5 ;')->fetchAll();
// $listingAuto = $db->query('SELECT * FROM auto INNER JOIN voertuig on voertuig.VoertuigId = auto.Kenteken LIMIT 5;')->fetchAll();
// $listingBoot = $db->query('SELECT * FROM boot INNER JOIN voertuig on voertuig.VoertuigId = boot.BootId LIMIT 5;')->fetchAll();

require basePath('models/Car.php');
$listingAuto = Car::getMany();

$listingFiets = [];
$listingBoot = [];


loadView('onze-voertuigen/listings' , [
    'listingFiets' => $listingFiets,
    'listingAuto' => $listingAuto ,
    'listingBoot' => $listingBoot,
]);

?>