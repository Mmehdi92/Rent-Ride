<?php

namespace Interfaces;

interface ReserveringInterface
{
    public function getProperty(string $property);
    public function addReservering();
    public static function getManyReserveringByHuurderId($huurderId);
    public static function getOneById($id);
    public function deleteReservering($id);
    public function payReservering($id);
    public function cancelReservering($id);
}
