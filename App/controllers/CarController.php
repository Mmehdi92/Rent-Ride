<?php

namespace Controllers;

use Framework\Valadation;
use Models\Car;

class CarController
{

    public function showCreateCar()
    {
        loadView('/dashboard/verhuurder/create/create-auto');
    }

    public function showCarListing()
    {
        $userId = 'NL58ABNA0512396433';
        $carList = Car::getManyByUserId($userId);

        loadView('/dashboard/verhuurder/listing/listing-car', ['carList' => $carList]);
    }

    public function createCar()
    {

        // allowd fields array
        $allowFields = ['optionsOnderneming', 'kleur', 'kenteken', 'model', 'kofferbakruimte', 'bouwjaar', 'dakrails', 'zitplaatsen', 'prijsPerDag', 'trekhaak', 'aandrijving', 'actief'];

        $newCarData =  array_intersect_key($_POST, array_flip($allowFields));
        $newCarData['optionsOnderneming'] =  87654321;
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
            loadView('dashboard/verhuurder/create/create-auto', ['errors' => $errors, 'newCaraData' => $newCarData]);
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


            inspect($result);
            if ($result !== false) {
                redirect('/onze-voertuigen');
            } else {
                loadView('dashboard/verhuurder/create/create-auto', ['errors' => 'Er is iets misgegaan', 'newCaraData' => $newCarData]);
            }
        }
    }

    public function deleteCar($params)
    {

        if (!isset($params['id'])) {
            redirect('/listing-car');
            exit;
        }
        $id = $params['id'];

        $car = CAR::getOne($id);

        if (!$car) {
            ErrorController::notFound('Car not found');
            return;
        }
        $result = $car->deleteOne($id);


        if ($result) {
            // Set flash message
            $_SESSION['succes_message'] = '🚘 Auto  succesvol verwijderd ✅    ';
            redirect('/listing-car');
        } else {
            ErrorController::notFound('Car not Deleted');
        }
    }

    public function showEditCar($params)
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
        loadView('/dashboard/verhuurder/edit/edit-auto', ['car' => $car]);
    }

    public function updateCar($params)
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

        // allowd fields array
        $allowFields = ['optionsOnderneming', 'kleur', 'kenteken', 'model', 'kofferbakruimte', 'bouwjaar', 'dakrails', 'zitplaatsen', 'prijsPerDag', 'trekhaak', 'aandrijving', 'actief'];

        $updateValues = [];

        $updateValues =  array_intersect_key($_POST, array_flip($allowFields));
        $updateValues['optionsOnderneming'] =  87654321;
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
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }

        if (!empty($errors)) {
            loadView('dashboard/verhuurder/edit/edit-auto', ['errors' => $errors, 'car' => $car]);
            exit;
        } else {
            $result = $car->updateCar($updateValues);
        }

        if ($result) {
            $_SESSION['succes_message'] = '🚘 Auto  succesvol geupdate ✅    ';
            redirect('/listing-car');
        } else {
            ErrorController::notFound('Car not Updated');
        }
    }
}
