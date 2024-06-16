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
        // allow on  if the user is a verhuurder
        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/');
            exit;
        }

        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);
        loadView('/dashboard/verhuurder/create/create-boot', ['ondermingsList' => $ondermingsList]);
    }

    public function createBoat()
    {
        // allow on  if the user is a verhuurder
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

        // if there are errors load the view with the errors
        if (!empty($errors)) {
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
        Session::set('succes_message', 'Boot succesvol toegevoegd ✅');
        // if the boat is added redirect to the listing page
        if ($result !== false) {
            redirect('  /listing-vehicles');
        } else {
            loadView('/dashboard/verhuurder/create/create-boot', ['errors' => ['Er is iets misgegaan']]);
        }
    }


    public function deleteBoat($params)
    {

        // allow on  if the user is a verhuurder
        if (!isset($params['id'])) {
            redirect('/onze-voertuigen');
            exit;
        }

        $boat = Boat::getOne($params['id']);
        // if thereis no boat redirect to the listing page
        if ($boat) {
            $boat->deleteBoat();
            redirect('/listing-vehicles');
            exit;
        } else {
            loadView('/dashboard/verhuurder/edit/edit-boot', ['errors' => ['Er is iets misgegaan']]);
        }
    }

    public function  showEditBoat($params)
    {
        // allow on  if the user is a verhuurder
        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/');
            exit;
        }

        $id = $params['id'];
        $boat = Boat::getOne($id);
        $ondermingsList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);

        // if there is no boat or ondermingsList redirect to the listing page
        if ($boat && $ondermingsList) {
            loadView('/dashboard/verhuurder/edit/edit-boot', ['boat' => $boat, 'ondermingsList' => $ondermingsList]);
        } else {
            redirect('/onze-voertuigen');
        }
    }


    public function updateBoat($params)
    {
        // allow on  if the user is a verhuurder
        if (!$verhuurder = Session::get('verhuurder')) {
            ErrorController::unAuthorized('Unauthorized');
            exit;
        }
        if (!isset($params['id'])) {
            ErrorController::notFound('Boat not found');
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
        // change array form numeric to  associative array
        $updateValues =  array_intersect_key($_POST, array_flip($allowFields));

        //add boat id to the array
        $updateValues['voertuigId'] = $boat->getProperty('voertuigId');

        // trim white spaces
        $updateValues = array_map('sanatizeData', $updateValues);

        // Required fields
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

        //instantiat errors array
        $errors = [];


        //loop through required fields and check if they are empty if not add them to the errors array
        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Valadation::string($updateValues[$field])) {
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }

        //if there are errors load the view with the errors
        if (!empty($errors)) {
            loadView('/dashboard/verhuurder/edit/edit-boot', ['errors' => $errors, 'boat' => $boat, 'ondermingsList' => $ondermingsList]);
            exit;
        }

        //get the boat id and add it to the array
        $updateValues['bootId'] = $boat->getProperty('bootId');

        //update the boat
        $boat->updateBoat($updateValues);

        //set a success message
        Session::set('succes_message', 'Boat succesvol geupdate ✅');
        if ($boat) {
            redirect('/listing-vehicles');
        } else {
            loadView('/dashboard/verhuurder/edit/edit-boot', ['errors' => ['Er is iets misgegaan']]);
        }
    }
}
