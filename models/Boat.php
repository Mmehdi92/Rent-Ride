<?php
require_once 'Vehicle.php';
class Boat extends Vehicle{

    private int $bootId;
    private float $lengte;
    private float $breedte;
    private string $aandrijving;
    private bool $vaarBewijs;

    function __construct()
    {
        
    }

}


?>