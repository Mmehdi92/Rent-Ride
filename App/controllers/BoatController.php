<?php

namespace Controllers;

use Models\Onderneming;
use Framework\Session;
use Models\Boat;
use Framework\Valadation;

class BoatController
{


    public function showCreateBoat()
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/');
            exit;
        }

        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);
        loadView('/dashboard/verhuurder/create/create-boot', ['ondermingsList' => $ondermingsList]);
    }

    public function createBoat()
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/');
            exit;
        }

        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);

       

        // allowd fields array voor boten
        $allowFields = [
            'optionsOnderneming',
            'kleur',
            'model',
            'bouwjaar',
            'zitplaatsen',
            'prijsPerDag',
            'actief',
            'lengte',
            'breedte',
            'aandrijving',
            'vaarbewijs'
        ];

        // flip the array van  numerieke index naar Assc index
        $newBoatData =  array_intersect_key($_POST, array_flip($allowFields));


        // Sanatize data

        $newBoatData = array_map('sanatizeData', $newBoatData);

        // Required fields

        $requiredFields = [
            'optionsOnderneming',
            'kleur',
            'model',
            'bouwjaar',
            'zitplaatsen',
            'prijsPerDag',
            'actief',
            'lengte',
            'breedte',
            'aandrijving',
            'vaarbewijs'
        ];

        $errors = [];

        // Validate required fields

        foreach ($requiredFields as $field) {
            if (!isset($newBoatData[$field]) || empty($newBoatData[$field])) {
                $errors[$field] =  ucfirst($field) . ' Dit veld is verplicht';
            }
        }


        if (!empty($errors)) {
            // inspectAndDie($newBoatData);
            loadView('/dashboard/verhuurder/create/create-boot', ['errors' => $errors, 'newBoatData' => $newBoatData, 'ondermingsList' => $ondermingsList]);
            exit;
        }


        $boat = new Boat(
            0,
            $newBoatData['optionsOnderneming'],
            $newBoatData['kleur'],
            $newBoatData['model'],
            $newBoatData['bouwjaar'],
            $newBoatData['zitplaatsen'],
            $newBoatData['prijsPerDag'],
            $newBoatData['actief'],
            0,
            $newBoatData['lengte'],
            $newBoatData['breedte'],
            $newBoatData['aandrijving'],
            $newBoatData['vaarbewijs']
        );

        $result = $boat->addBoat();

        if ($result !== false) {
            redirect('  /listing-vehicles');
        } else {
            loadView('/dashboard/verhuurder/create/create-boot', ['errors' => ['Er is iets misgegaan']]);
        }
    }


    public function deleteBoat($params)
    {
        if (!isset($params['id'])) {
            redirect('/onze-voertuigen');
            exit;
        }

        $boat = Boat::getOne($params['id']);

        if ($boat) {
            $result = $boat->deleteBoat();

            if ($result !== false) {
                redirect('/onze-voertuigen');
            } else {
                loadView('/dashboard/verhuurder/edit/edit-boot', ['errors' => ['Er is iets misgegaan']]);
            }
        } else {
            redirect('/listing-vehicles');
        }
    }

    public function  showEditBoat($params)
    {

        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/');
            exit;
        }

        $id = $params['id'];
        $boat = Boat::getOne($id);
        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);




        if ($boat) {

            loadView('/dashboard/verhuurder/edit/edit-boot', ['boat' => $boat, 'ondermingsList' => $ondermingsList]);
        } else {
            redirect('/onze-voertuigen');
        }
    }

    public function updateBoat($params)
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

        $boat = Boat::getOne($id);
        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);

        if (!$boat && !$ondermingsList) {
            ErrorController::notFound('Boat not found');
            exit;
        }


        // allowd fields array voor boten
        $allowFields = [
            'optionsOnderneming',
            'kleur',
            'model',
            'bouwjaar',
            'zitplaatsen',
            'prijsPerDag',
            'actief',
            'lengte',
            'breedte',
            'aandrijving',
            'vaarbewijs'
        ];

        $updateValues =  array_intersect_key($_POST, array_flip($allowFields));

        $updateValues['voertuigId'] = $boat->getProperty('voertuigId');

        $updateValues = array_map('sanatizeData', $updateValues);

        $requiredFields = [
            'optionsOnderneming',
            'voertuigId',
            'kleur',
            'model',
            'bouwjaar',
            'zitplaatsen',
            'prijsPerDag',
            'actief',
            'lengte',
            'breedte',
            'aandrijving',
            'vaarbewijs'
        ];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Valadation::string($updateValues[$field])) {
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }

        if (!empty($errors)) {
            loadView('/dashboard/verhuurder/edit/edit-boot', ['errors' => $errors, 'boat' => $boat , 'ondermingsList' => $ondermingsList]);
            exit;
        }

  
        $updateValues['bootId'] = $boat->getProperty('bootId');
     
        $result =  $boat->updateBoat($updateValues);

        if ($result) {
            $_SESSION['succes_message'] = '🚤 Boot  succesvol geupdate ✅    ';
            redirect('/listing-vehicles');
        } else {
            ErrorController::notFound('Boat not Updated');
        }


        
    }
}
