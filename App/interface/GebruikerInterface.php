<?php

namespace Interfaces;

interface GebruikerInterface
{
    public function getAllUsersByEmail($email); 
    public function getAllUsers($id); 
    public static function getUserByEmail($email);
}