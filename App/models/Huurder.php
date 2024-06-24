<?php

namespace Models;

use Framework\Database;
use PDOException;

final class Huurder extends Gebruiker
{
    private string $huurderId;
    private string $rijbewijs;
    private string $vaarbewijs;

    function __construct(
        string $Iban,
        string $voorNaam,
        string $achterNaam,
        string $postCode,
        string $huisNummer,
        string $email,
        string $wachtwoord,
        int $telefoonNummer,
        string $geboorteDatum,
        bool $actief,
        string $huurderId,
        string $rijbewijs,
        string $vaarbewijs
    ) {
        parent::__construct($Iban, $voorNaam, $achterNaam, $postCode, $huisNummer, $email, $wachtwoord, $telefoonNummer, $geboorteDatum, $actief);
        $this->huurderId = $huurderId;
        $this->rijbewijs = $rijbewijs;
        $this->vaarbewijs = $vaarbewijs;
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
            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $user;
    }

    public function addHuurder()
    {
        try {
            $db = Database::getInstance();
            $db->query('START TRANSACTION');


            $insertGebruiker = $db->query(
                'INSERT INTO gebruiker 
                (Iban, voorNaam, achterNaam, postCode, huisNummer, email, wachtwoord, telefoonNummer, geboorteDatum, actief) 
                VALUES 
                (:Iban, :voorNaam, :achterNaam, :postCode, :huisNummer, :email, :wachtwoord, :telefoonNummer, :geboorteDatum, :actief)',
                [
                    'Iban' => $this->Iban,
                    'voorNaam' => $this->voorNaam,
                    'achterNaam' => $this->achterNaam,
                    'postCode' => $this->postCode,
                    'huisNummer' => $this->huisNummer,
                    'email' => $this->email,
                    'wachtwoord' => $this->wachtwoord,
                    'telefoonNummer' => $this->telefoonNummer,
                    'geboorteDatum' => $this->geboorteDatum,
                    'actief' => $this->actief
                ]
            );



            $vaarbewijsValue = ($this->vaarbewijs === 'true') ? 1 : 0;
            $insertHuurder = $db->query(
                'INSERT INTO huurder (huurderId, rijbewijs, vaarbewijs) VALUES (:huurderId, :rijbewijs, :vaarbewijs)',
                [
                    'huurderId' => $this->Iban,
                    'rijbewijs' => $this->rijbewijs,
                    'vaarbewijs' => $vaarbewijsValue
                ]
            );





            $db->query('COMMIT');
        } catch (PDOException $e) {
            $db->query('ROLLBACK');
            echo $e->getMessage();
        }
    }
    public static function getUserByEmail($email)
    {
        try {
            $db = Database::getInstance();
            $user = $db->query('
            SELECT gebruiker.*, huurder.huurderId, huurder.rijbewijs, huurder.vaarbewijs
            FROM gebruiker
            JOIN huurder ON gebruiker.Iban = huurder.huurderId
            WHERE gebruiker.email = :email
            ', ['email' => $email])->fetch();
            return  $user;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }


    public function getProperty($property)
    {
        return $this->$property;
    }
}
