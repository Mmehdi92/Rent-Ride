<?php 
namespace Controllers;

Class CreateVehicleController
{
    public function __construct()
    {
        // die('CreateVehicleController');
    }

    public function showCreateCar()
    {
        loadView('/create/create-auto');
    }

    public function showCreateBoat()
    {
        loadView('/create/create-boot');
    }

    public function showCreateBycicle()
    {
        loadView('/create/create-fiets');
    }
}