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

    public function getVoorNaam()
    {
        return $this->voorNaam;
    }

    public function getAchterNaam()
    {
        return $this->achterNaam;
    }

    public function getPostCode()
    {
        return $this->postCode;
    }

    public function getHuisNummer()
    {
        return $this->huisNummer;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }

    public function getTelefoonNummer()
    {
        return $this->telefoonNummer;
    }

    public function getGeboorteDatum()
    {
        return $this->geboorteDatum;
    }

    

    public static function getAdminByEmail($email)
    {
        try {
            $db = Database::getInstance();
            $admin = $db->query('SELECT * FROM beheerder where email = :email', ['email' => $email])->fetch();
                     
            $admin = new Admin(
                $admin->Voornaam,
                $admin->Achternaam,
                $admin->Postcode,
                $admin->Huisnummer,
                $admin->Email,
                $admin->Wachtwoord,
                $admin->TelefoonNummer,
                $admin->Geboortedatum
            );
            
        
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
