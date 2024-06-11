<?php

namespace Models;

use DateTime;

class Verhuurder extends Gebruiker
{
    private string $verhuurderId;

    function __construct(string $Iban, string $voorNaam, string $achterNaam, string $postCode, string $huisNummer, string $email, string $wachtwoord, int $telefoonNummer, \DateTime $geboorteDatum, bool $actief, string $verhuurderId)
    {
        parent::__construct($Iban, $voorNaam, $achterNaam, $postCode, $huisNummer, $email, $wachtwoord, $telefoonNummer, $geboorteDatum, $actief);
        $this->verhuurderId = $verhuurderId;
    }

    public function getProperty($property)
    {
        return $this->$property;
    }
}
