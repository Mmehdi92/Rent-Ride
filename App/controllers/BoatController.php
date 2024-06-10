<?php

namespace Controllers;

class BoatController
{

    
    public function showCreateBoat()
    {
        loadView('/create/create-boot');
    }

    public function createBoat(){
        inspectAndDie($_POST);
    }
}