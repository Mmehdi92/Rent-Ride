<?php

namespace Controllers;

use Models\Car;
use Models\Boat;
use Models\Bycicle;

use Framework\Database;
use Models\Zoektermen;

use function PHPUnit\Framework\isEmpty;

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


    public function search()
    {
      
        $searchTerm1 = isset($_GET['searchTerm1']) ? trim($_GET['searchTerm1']) : '';
        $searchTerm2 = isset($_GET['searchTerm2']) ? trim($_GET['searchTerm2']) : '';

            //intialize the Zoekterm Object object
            $failedSearched =  $searchTerm1 . ' - ' . $searchTerm2;
            $searchNoResult = new Zoektermen(
                $failedSearched
            );


            $carsList = Car::searchModel($searchTerm1, $searchTerm2);
            $boatList = Boat::searchModel($searchTerm1, $searchTerm2);

            //failed search - Add to Zoektermen table
            if (count($carsList) == 0 &&  count($boatList) == 0) {
                $searchNoResult->addZoekterm($failedSearched);
            }
inspectAndDie($boatList);
            loadView('/onze-voertuigen/listings', [
                'listingAuto' => $carsList,
                'listingBoot' => $boatList,
            ]);
        
    }
}
