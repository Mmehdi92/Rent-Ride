<?php

namespace Interfaces;

interface CarInterface
{
    public static function getManyByCarsId($id);
    public function addCar();
    public function deleteOne($id);
    public function updateCar($updateValues);
   
}
?>
