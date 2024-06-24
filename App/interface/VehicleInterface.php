<?php

namespace Interfaces;

interface VehicleInterface
{
    public static function getManyActief();
    public static function getMany(); 
    public static function getOne($id);
}