<?php
require_once basePath('models/Boat.php');
// $config = require basePath('config/db.php');
// $db = new Database($config);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $boat = Boat::getOne($id);

    if (!$boat) {
        header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
        exit;
    }
} else {
    header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
    exit;
}



loadView('onze-voertuigen/details/show-boat-details', ['boot' => $boat]);
