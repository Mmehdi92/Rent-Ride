<?php

namespace Controllers;

class BoatController
{

    
    public function showCreateBoat()
    {
        loadView('dashboard/verhuurder/create/create-boot');
    }

    public function createBoat(){
        inspectAndDie($_POST);
        loadView('dashboardverhuurder/create/create-boot');
    }
}