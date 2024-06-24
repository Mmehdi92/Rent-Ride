<?php

namespace Controllers;

use Error;
use Framework\Session;
use Framework\Valadation;
use Models\Car;
use Models\Onderneming;
use Models\Boat;

class CarController
{
    public function showCreateCar()
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/');
            exit;
        }


        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);

        loadView('/dashboard/verhuurder/create/create-auto', ['ondermingsList' => $ondermingsList]);
    }

    public function showCarListing()
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/login');
            exit;
        }

        $carList = Car::getManyByCarsId($verhuurder['id']);
        loadView('/dashboard/verhuurder/listing/listing-vehicles', ['carList' => $carList]);
    }

    public function createCar()
    {

        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/login');
            exit;
        }

        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);

        // allowd fields array
        $allowFields = [
            'optionsOnderneming',
            'kleur',
            'kenteken',
            'model',
            'kofferbakruimte',
            'bouwjaar',
            'dakrails',
            'zitplaatsen',
            'prijsPerDag',
            'trekhaak',
            'aandrijving',
            'actief'
        ];

        $newCarData =  array_intersect_key($_POST, array_flip($allowFields));

        // Sanatize data
        $newCarData = array_map('sanatizeData', $newCarData);

        // Required fields
        $requiredFields = [
            'optionsOnderneming',
            'kleur',
            'kenteken',
            'model',
            'kofferbakruimte',
            'bouwjaar',
            'dakrails',
            'zitplaatsen',
            'prijsPerDag',
            'trekhaak',
            'aandrijving',
            'actief'
        ];
        // Errors array if there are any
        $erros = [];
        // Check if the required fields are empty or not
        foreach ($requiredFields as $field) {
            if (empty($newCarData[$field]) || !Valadation::string($newCarData[$field])) {
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }



        //render errors if any
        if (!empty($errors)) {
            loadView('dashboard/verhuurder/create/create-auto', ['errors' => $errors, 'newCaraData' => $newCarData, 'ondermingsList' => $ondermingsList ?? []]);
        } else {
            // Create a new car object
            $newCar = new Car(
                0,
                $newCarData['optionsOnderneming'],
                $newCarData['kleur'],
                $newCarData['model'],
                $newCarData['bouwjaar'],
                $newCarData['zitplaatsen'],
                $newCarData['prijsPerDag'],
                $newCarData['actief'],
                0,
                $newCarData['kenteken'],
                $newCarData['kofferbakruimte'],
                $newCarData['dakrails'],
                $newCarData['trekhaak'],
                $newCarData['aandrijving']
            );



            $result = $newCar->addCar();


            if ($result !== false) {
                redirect('/listing-vehicles');
            } else {
                $_SESSION['succes_message'] = '🚘 Auto  succesvol toegevoegd ✅    ';
                loadView('dashboard/verhuurder/create/create-auto', ['errors' => 'Er is iets misgegaan', 'newCaraData' => $newCarData]);
            }
        }
    }

    public function deleteCar($params)
    {


        if (!isset($params['id'])) {
            ErrorController::notFound('Car not found');
            exit;
        }
        $id = $params['id'];

        $car = CAR::getOne($id);;
        if (!$car) {
            ErrorController::notFound('Car not found');
            return;
        }
        $result = $car->deleteOne($id);


        if ($result) {
            // Set flash message
            $_SESSION['succes_message'] = '🚘 Auto  succesvol verwijderd ✅    ';
            redirect('/listing-vehicles');
        } else {
            ErrorController::notFound('Car not Deleted');
        }
    }

    public function showEditCar($params)
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/login');
            exit;
        }

        $id = $params['id'];
        $car = Car::getOne($id);

        //load  user session id en de ondernemingen van de verhuurder
        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);

        if (!$car) {
            ErrorController::notFound('Car not found');
            exit;
        }
        loadView('/dashboard/verhuurder/edit/edit-auto', ['car' => $car, 'ondermingsList' => $ondermingsList]);
    }

    public function updateCar($params)
    {

        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/login');
            exit;
        }
        if (!isset($params['id'])) {
            ErrorController::notFound('Car not found');
            exit;
        }
        $id = $params['id'];
        $car = Car::getOne($id);
        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);


        if (!$car && !$ondermingsList) {
            ErrorController::notFound('Car not found');
            exit;
        }

        // allowd fields array
        $allowFields = ['optionsOnderneming', 'kleur', 'kenteken', 'model', 'kofferbakruimte', 'bouwjaar', 'dakrails', 'zitplaatsen', 'prijsPerDag', 'trekhaak', 'aandrijving', 'actief'];
        
        $updateValues = [];
        $updateValues =  array_intersect_key($_POST, array_flip($allowFields));
        $updateValues['voertuigId'] = $car->getProperty('voertuigId');
        $updateValues = array_map('sanatizeData', $updateValues);
        
        $requiredFields = [
            'optionsOnderneming',
            'voertuigId',
            'kleur',
            'kenteken',
            'model',
            'kofferbakruimte',
            'bouwjaar',
            'dakrails',
            'zitplaatsen',
            'prijsPerDag',
            'trekhaak',
            'aandrijving',
            'actief'
        ];
        
        $errors = [];
        
        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Valadation::string($updateValues[$field])) {
                inspectAndDie($field    );
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }

        if (!empty($errors)) {
            loadView('dashboard/verhuurder/edit/edit-auto', ['errors' => $errors, 'car' => $car, 'ondermingsList' => $ondermingsList]);
            exit;
        }

        $result = $car->updateCar($updateValues);


        if ($result) {
            // Set flash message
            $_SESSION['succes_message'] = '🚘 Auto  succesvol geupdate ✅    ';
            redirect('/listing-vehicles');
        } else {
            ErrorController::notFound('Car not Updated');
        };
    }
}
