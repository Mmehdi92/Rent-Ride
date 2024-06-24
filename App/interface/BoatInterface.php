<?php

namespace Interfaces;

interface BoatInterface
{
    public function addBoat(); 
    public static function getManyByVerhuurderId($verhuurderId); 
    public function deleteBoat(); 
    public function updateBoat($updateValues); 
    
}
