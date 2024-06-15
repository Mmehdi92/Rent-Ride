<?php

namespace Controllers;

use Models\Car;
use Models\Boat;
use Models\Bycicle;

use Framework\Database;
use Models\Zoekterm;



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
           ErrorController::notFound('Auto niet gevonden');
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
            ErrorController::notFound('Boot niet gevonden');
            exit;
        }
        loadView('onze-voertuigen/details/show-boat-details', ['boot' => $boat]);
    }

    public function showBycicleDetails($params)
    {
;
        if (!isset($params['id'])) {
            redirect('/onze-voertuigen');
            exit;
        }
        $id = $params['id'];

        $bycicle = Bycicle::getOne($id);
        

        if (!$bycicle) {
            ErrorController::notFound('Fiets niet gevonden');
            exit;
        }

        loadView('onze-voertuigen/details/show-bycicle-details', ['fiets' => $bycicle]);
    }


    public function search()
    {

        $searchTerm1 = trim(isset($_GET['searchTerm1'])) ? trim($_GET['searchTerm1']) : '';
        $searchTerm2 = trim(isset($_GET['searchTerm2'])) ? trim($_GET['searchTerm2']) : '';

        //intialize the Zoekterm Object object
        $failedSearched = trim($searchTerm1) .' - ' . trim($searchTerm2);
        $searchNoResult = new Zoekterm(
            0,
            $failedSearched,
            date('Y-m-d H:i:s')
        );


        $carsList = Car::searchModel($searchTerm1, $searchTerm2);
        $boatList = Boat::searchModel($searchTerm1, $searchTerm2);

        //failed search - Add to Zoektermen table
        if (count($carsList) == 0 &&  count($boatList) == 0) {
            $searchNoResult->addZoekterm($failedSearched);
        }

        loadView('/onze-voertuigen/listings', [
            'listingAuto' => $carsList,
            'listingBoot' => $boatList,
        ]);
    }
}
