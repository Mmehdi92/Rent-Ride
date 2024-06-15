<?php

namespace Models;

use Framework\Database;
use PDOException;

class Admin
{
    private string $voorNaam;
    private string $achterNaam;
    private string $postCode;
    private string $huisNummer;
    private string $email;
    private string $wachtwoord;
    private int $telefoonNummer;
    private string $geboorteDatum;

    function __construct(string $voornaam, string $achternaam, string $postcode, string $huisnummer, string $email, string $wachtwoord, int $telefoonnummer, string $geboortedatum)
    {
        $this->voorNaam = $voornaam;
        $this->achterNaam = $achternaam;
        $this->postCode = $postcode;
        $this->huisNummer = $huisnummer;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
        $this->telefoonNummer = $telefoonnummer;
        $this->geboorteDatum = $geboortedatum;
    }


    public static function getAdminByEmail($email)
    {
        try {
            $db = Database::getInstance();
            $admin = $db->query('SELECT * FROM beheerder where email = :email', ['email' => $email])->fetch();
            return $admin;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProperty($property)
    {
        return $this->$property;
    }
}
