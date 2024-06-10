<?php

namespace Controllers;

class BoatController
{
    public function __construct()
    {
        
    }

    public function showCreateBoat()
    {
        loadView('/create/create-boot');
    }

    public function createBoat(){
        inspectAndDie($_POST);
    }
}