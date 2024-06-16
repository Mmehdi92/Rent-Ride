<?php

namespace Models;

use Framework\Database;
use PDOException;


class Verhuurder extends Gebruiker
{
    private string $verhuurderId;

    function __construct(string $Iban, string $voorNaam, string $achterNaam, string $postCode, string $huisNummer, string $email, string $wachtwoord, int $telefoonNummer, string $geboorteDatum, bool $actief, string $verhuurderId)
    {
        parent::__construct($Iban, $voorNaam, $achterNaam, $postCode, $huisNummer, $email, $wachtwoord, $telefoonNummer, $geboorteDatum, $actief);
        $this->verhuurderId = $verhuurderId;
    }

    public function getProperty($property)
    {
        return $this->$property;
    }

    public function getAllUsers($id)
    {

        try {
            $db = Database::getInstance();
            $user = $db->query('SELECT * FROM gebruiker where Iban = :Iban', ['Iban' => $id])->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $user;
    }


    public function getAllUsersByEmail($email)
    {

        try {
            $db = Database::getInstance();
            $user = $db->query('SELECT * FROM gebruiker where email = :email', ['email' => $email])->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        };
    }


    public function  addVerhuurder()
    {
        try {
            $db = Database::getInstance();

            $db->query('START TRANSACTION');

            $insertGebruiker = $db->query(
                'INSERT INTO gebruiker 
            (Iban, VoorNaam, AchterNaam, PostCode, HuisNummer, Email, Wachtwoord, TelefoonNummer, GeboorteDatum, Actief ) 
            VALUES (:Iban, :VoorNaam, :AchterNaam, :PostCode, :HuisNummer, :Email, :Wachtwoord, :TelefoonNummer, :GeboorteDatum, :Actief)',
                [
                    'Iban' => $this->Iban,
                    'VoorNaam' => $this->voorNaam,
                    'AchterNaam' => $this->achterNaam,
                    'PostCode' => $this->postCode,
                    'HuisNummer' => $this->huisNummer,
                    'Email' => $this->email,
                    'Wachtwoord' => $this->wachtwoord,
                    'TelefoonNummer' => $this->telefoonNummer,
                    'GeboorteDatum' => $this->geboorteDatum,
                    'Actief' => $this->actief,
                ]
            );

            $insertVerhuurder = $db->query(
                'INSERT INTO verhuurder (VerhuurderId) VALUES (:VerhuurderId)',
                ['VerhuurderId' => $this->verhuurderId]
            );


            if ($insertGebruiker && $insertVerhuurder) {
                $db->query('COMMIT');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function getUserByEmail($email)
    {
        try {
            $db = Database::getInstance();
            $user = $db->query('SELECT gebruiker.*, verhuurder.VerhuurderId
                FROM gebruiker
                LEFT JOIN verhuurder ON gebruiker.Iban = verhuurder.VerhuurderId
                WHERE gebruiker.Email = :email', ['email' => $email])->fetch();
                
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $user;
    }
}
