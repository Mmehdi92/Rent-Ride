<?php

namespace Interfaces;

interface ZoektermInterface
{
    public function getProperty($property);
    public function addZoekterm($zoekterm);
    public function deleteZoekterm($id);
    public static function getOne($id);
    public static function getAllZoektermen();
}
