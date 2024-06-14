<?php
namespace Controllers;
use Framework\Session;
use Models\Car;
use Models\Boat;
use Models\Bycicle;

class VoertuigenController
{
    public function showMijnVoertuigen()
    {
        if (!$verhuurder = Session::get('verhuurder')) {
            redirect('/login');
            exit;
        }
        $boatList = Boat::getManyByBoatsId($verhuurder['id']);
        $carList = Car::getManyByCarsId($verhuurder['id']);
        loadView('/dashboard/verhuurder/listing/listing-vehicle', ['carList' => $carList, 'boatList' => $boatList]);
    }


}