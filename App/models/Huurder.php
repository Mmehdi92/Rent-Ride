<?php
namespace Models;

class Huurder extends Gebruiker{



    public function getProperty($property)
    {
        return $this->$property;
    }
}