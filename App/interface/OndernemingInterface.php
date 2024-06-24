<?php
namespace Interfaces;

interface OndernemingInterface
{
    public function getProperty($property);
    public function getAllOndernemingByKVK($kvk);
    public static function getAllOndernemingByVerhuurdersId($verhuurdersId);
    public function addOnderneming();
    public static function getOne($kvkNummer);
    public function deleteOne($kvkNummer);
    public function getFullOndernemingsAdres($postcode, $huisnummer);
    public function updateOnderneming($updateValues);
}