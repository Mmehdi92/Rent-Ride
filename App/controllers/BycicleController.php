<?php
namespace Controllers;

class BycicleController
{
    public function __construct()
    {
        
    }
    public function showCreateBycicle()
    {
        loadView('dashboard/verhuurder/create/create-fiets');
    }
    public function createBycicle(){
        inspectAndDie($_POST);
    }
}