<?php

namespace Controllers;

use Models\Car;
use Models\Boat;
use Models\Bycicle;


class OnzeVoertuigenController
{


    public function index()
    {
        $listingAuto = Car::getManyActief();
        $listingBoot = Boat::getManyActief();
        $listingFiets = Bycicle::getMany();


        loadView('onze-voertuigen/listings', [
            'listingFiets' => $listingFiets,
            'listingAuto' => $listingAuto,
            'listingBoot' => $listingBoot,
        ]);
    }


    public function showCarDetails($params)
    {
        if (!isset($params['id'])) {
            header('Location: /onze-voertuigen');
            exit;
        }
        $id = $params['id'];
        $car = Car::getOne($id);

       
        if (!$car) {
            header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
            exit;
        }
        loadView('onze-voertuigen/details/show-car-details', ['auto' => $car]);
    }

    public function showBoatDetails($params)
    {
        if (!isset($params['id'])) {
            header('Location: /onze-voertuigen');
            exit;
        }
        $id = $params['id'];
        $boat = Boat::getOne($id);
        if (!$boat) {
            header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
            exit;
        }
        loadView('onze-voertuigen/details/show-boat-details', ['boot' => $boat]);
    }

    public function showBycicleDetails($params)
    {
        // inspectAndDie($params);
        if (!isset($params['id'])) {
            header('Location: /onze-voertuigen');
            exit;
        }
        $id = $params['id'];
        // inspectAndDie($id);
        $bycicle = Bycicle::getOne($id);
        // inspectAndDie($bycicle);

        if (!$bycicle) {
            header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
            exit;
        }

        loadView('onze-voertuigen/details/show-bycicle-details', ['fiets' => $bycicle]);
    }
}
