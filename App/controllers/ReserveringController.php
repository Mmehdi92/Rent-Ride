<?php

namespace Controllers;

use Controllers\ErrorController;
use Error;
use Framework\Session;
use Models\Car;
use Models\Boat;
use Models\Reservering;

class ReserveringController
{
    public function showMijnReserveringen()
    {
        if (!$huurder = Session::get('huurder') || !$verhuurder = Session::get('verhuurder')) {
            redirect('/login');
            exit;
        }
        loadView('/dashboard/huurder/listing/listing-reservering');
    }

    public function showCreateReservering($params)
    {
        $listingAuto = Car::getManyActief();
        $listingBoot = Boat::getManyActief();

        if (!$huurder = Session::get('huurder') || !$verhuurder = Session::get('verhuurder')) {
            redirect('/');
            exit;
        }

        if (!isset($params['id'])) {
            ErrorController::notFound('Auto niet gevonden.');
            exit;
        }
        $id = $params['id'];

        try {
            $voertuig = Car::getOne($id);

            if (!$voertuig) {
                $voertuig = Boat::getOne($id);
            }

            if (!$voertuig) {
                ErrorController::notFound('Voertuig niet gevonden.');
                exit;
            }

            loadView('/dashboard/huurder/create/create-reservering', [
                'voertuig' => $voertuig,
                'listingAuto' => $listingAuto,
                'listingBoot' => $listingBoot
            ]);
        } catch (Error $e) {
            ErrorController::notFound('Voertuig niet gevonden.');
            exit;
        }
    }

    public function createReservering()
    {
        if (!$huurder = Session::get('huurder') || !$verhuurder = Session::get('verhuurder')) {
            ErrorController::unAuthorized('U bent niet gemachtigd om deze actie uit te voeren.');
            exit;
        }
      


        $allowdFields = [
            'beginDatumTijd',
            'eindDatumTijd',
            'voertuigId'
        ];

        $newReserveringData = array_intersect_key($_POST, array_flip($allowdFields));
        $newReserveringData = array_map('sanatizeData', $newReserveringData);

        $requiredFields = [
            'beginDatumTijd',
            'eindDatumTijd',
        ];

        $errors = [];


        foreach ($requiredFields as $field) {
            if (!isset($newReserveringData[$field]) || empty($newReserveringData[$field])) {
                $errors[$field] = ucfirst($field) . ' is verplicht';
            }
        }
        

        $voertuig = Car::getOne($newReserveringData['voertuigId']);
        if (!$voertuig) {
            $voertuig = Boat::getOne($newReserveringData['voertuigId']);
        }

        if (!empty($errors)) {
        
            loadView('/dashboard/huurder/create/create-reservering', [
                'errors' => $errors,
                'newReserveringData' => $newReserveringData,
               'voertuig' => $voertuig


            ]);;
            exit;
        }
        $huurderId = Session::get('huurder')['id'];
        $newReservering = new Reservering(
            0,
            $newReserveringData['beginDatumTijd'],
            $newReserveringData['eindDatumTijd'],
            "Pending",
            $huurderId,
            $newReserveringData['voertuigId']
        );

        // inspectAndDie($newReservering);
        $newReservering->addReservering();
        $_SESSION['succes_message'] = '🥳 Reservering  succesvol toegevoegd ✅    ';
        redirect('/listing-reservering');
    }
}
