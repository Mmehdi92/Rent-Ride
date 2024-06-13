<?php

namespace Controllers;

use Error;
use Framework\Session;
use Framework\Valadation;
use Models\Car;
use Models\Onderneming;
use Models\Adres;

class OndernemingController
{
    public function showCreateOnderneming()
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            loadView('login/login', ['errors' => 'U bent niet ingelogd als verhuurder']);
        }
        loadView('dashboard/verhuurder/create/create-onderneming');
    }

    public function createOnderneming()
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            loadView('login/login', ['errors' => 'U bent niet ingelogd als verhuurder']);
            exit;
        }

        // Allowed fields array
        $allowedFields = ['kvkNummer', 'ondernemingsnaam', 'telefoonnummer', 'huisnummer', 'postcode',  'straat', 'plaats'];
        $newOndernemingData = array_intersect_key($_POST, array_flip($allowedFields));

        // Sanitize data
        $newOndernemingData = array_map('sanatizeData', $newOndernemingData);

        // Required fields
        $requiredFields = ['kvkNummer', 'ondernemingsnaam', 'telefoonnummer', 'huisnummer', 'postcode',  'straat', 'plaats'];

        // Errors array if any
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($newOndernemingData[$field]) || !Valadation::string($newOndernemingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }


        if (!empty($errors)) {
            loadView('dashboard/verhuurder/create/create-onderneming', ['errors' => $errors]);
            exit;
        } else {
            $newAdres = new Adres(
                $newOndernemingData['postcode'],
                $newOndernemingData['huisnummer'],
                $newOndernemingData['straat'],
                $newOndernemingData['plaats'],
                'Nederland'
            );

            $newOndernemingData['verhuurderId'] = $verhuurder['id'];
            $onderneming = new Onderneming(
                $newOndernemingData['kvkNummer'],
                $newOndernemingData['ondernemingsnaam'],
                $newOndernemingData['telefoonnummer'],
                $newOndernemingData['huisnummer'],
                $newOndernemingData['postcode'],
                $newOndernemingData['verhuurderId']
            );

            // Controleer of het adres al bestaat
            $existingAdres = $newAdres->getAllAdresByPostcode($newOndernemingData['postcode'], $newOndernemingData['huisnummer']);
            if (!$existingAdres) {
                $newAdres->addAdres();
            }

            // Voeg de onderneming toe
            $result = $onderneming->addOnderneming();
            if ($result !== false) {
                $_SESSION['succes_message'] = 'Onderneming succesvol toegevoegd✅';
                redirect('/listing-onderneming');
            } else {
                loadView('dashboard/verhuurder/create/create-onderneming', ['errors' => 'Er is iets misgegaan, probeer het opnieuw']);
            }
        }
    }


    public function showOndernemingListing()
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            loadView('login/login', ['errors' => 'U bent niet ingelogd als verhuurder']);
        }

        $ondernemingList = Onderneming::getAllOndernemingByVerhuurdersId($verhuurder['id']);


        loadView('dashboard/verhuurder/listing/listing-onderneming', ['ondernemingList' => $ondernemingList]);
    }

    public function deleteOnderneming($params)
    {

        if (!isset($params['id'])) {
           ErrorController::notFound('Onderneming niet gevonden');
            exit;
        }

        $kvkNummer = $params['id'];

        $onderneming = Onderneming::getOne($kvkNummer);
        if (!$onderneming) {
            ErrorController::notFound('Onderneming niet gevonden');
            return;
        }
        $result = $onderneming->deleteOne($kvkNummer);
        if ($result) {
            // Set flash message
            $_SESSION['succes_message'] = ' Onderneming succesvol verwijderd ✅    ';
            redirect('/listing-onderneming');
        } else {
            ErrorController::notFound('Car not Deleted');
        }
    }

    public function updateOnderneming($params)
    {
        if (!isset($params['id'])) {
            ErrorController::notFound('Onderneming niet gevonden');
            exit;
        }
        $kvk = $params['id'];
        $onderneming = Onderneming::getOne($kvk);

        $allowdFields = [
            'ondernemingsnaam',
            'telefoonnummer',
            'huisnummer',
            'postcode',
            'straat',
            'plaats'
        ];
        $newOndernemingData = array_intersect_key($_POST, array_flip($allowdFields));

        $newOndernemingData = array_map('sanatizeData', $newOndernemingData);

        $requiredFields = [
            'ondernemingsnaam',
            'telefoonnummer',
            'huisnummer',
            'postcode',
            'straat',
            'plaats'
        ];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($newOndernemingData[$field]) || !Valadation::string($newOndernemingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }

        if (!empty($errors)) {
            loadView('dashboard/verhuurder/edit/edit-onderneming', ['errors' => $errors, 'onderneming' => $onderneming]);
            exit;
        }
        if ($onderneming->getProperty('postcode') !== $newOndernemingData['postcode'] || $onderneming->getProperty('huisnummer') !== $newOndernemingData['huisnummer']) {
            $newAdres = new Adres(
                $newOndernemingData['postcode'],
                $newOndernemingData['huisnummer'],
                $newOndernemingData['straat'],
                $newOndernemingData['plaats'],
                'Nederland'
            );

            $newAdres->addAdres();
        }

        $result = $onderneming->updateOnderneming($newOndernemingData);
        if ($result) {
            $_SESSION['succes_message'] = 'Onderneming succesvol geupdate ✅ ';
            redirect('/listing-car');
        } else {
            ErrorController::notFound('Car not Updated');
        }

        inspectAndDie($onderneming);
    }

    public function showEditOnderneming($params)
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            $errors = 'U bent niet ingelogd als verhuurder';
            redirect('/');
            exit;
        }


        if (!isset($params['id'])) {
            header('Location: /listing-onderneming');
            exit;
        }

        $kvkNummer = $params['id'];
        $onderneming = Onderneming::getOne($kvkNummer);
        $ondernemingsAdres = $onderneming->getFullOndernemingsAdres($onderneming->getProperty('postcode'), $onderneming->getProperty('huisnummer'));

        if (!$onderneming || !$ondernemingsAdres) {
            ErrorController::notFound('Onderneming niet gevonden');
            exit;
        }



        loadView('dashboard/verhuurder/edit/edit-onderneming', ['onderneming' => $onderneming, 'ondernemingsAdres' => $ondernemingsAdres]);
    }
}
