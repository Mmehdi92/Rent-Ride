<?php

namespace Controllers;

use Models\Car;
use Models\Boat;
use Models\Bycicle;

class OnzeVoertuigenController
{


    public function index()
    {
        $listingAuto = Car::getMany();
        $listingBoot = Boat::getMany();
        $listingFiets = Bycicle::getMany();


        loadView('onze-voertuigen/listings', [
            'listingFiets' => $listingFiets,
            'listingAuto' => $listingAuto,
            'listingBoot' => $listingBoot,
        ]);
    }


    public function showCarDetails()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $car = Car::getOne($id);

            if (!$car) {
                header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
                exit;
            }
        } else {
            header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
            exit;
        }
        loadView('onze-voertuigen/details/show-car-details', ['auto' => $car]);
    }

    public function showBoatDetails()
    {
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
    }

    public function showBycicleDetails()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $bycicle = Bycicle::getOne($id);

            if (!$bycicle) {
                header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
                exit;
            }
        } else {
            header('Location: /onze-voertuigen'); // kan ook een 404-pagina zijn of iets anders voor nu is dit goed genoeg
            exit;
        }
        loadView('onze-voertuigen/details/show-bycicle-details', ['fiets' => $bycicle]);
    }
}
