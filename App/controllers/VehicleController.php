<?php 
namespace Controllers;

Class VehicleController
{
    public function __construct()
    {
        
    }
// Car Section









// Boat Section 
    public function showCreateBoat()
    {
        loadView('/create/create-boot');
    }












// Bycicle Section
    public function showCreateBycicle()
    {
        loadView('/create/create-fiets');
    }
}