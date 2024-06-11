<?php

namespace Models;

class Huurder extends Gebruiker
{

    private string $huurderId;
    private string $rijebwijs;
    private string $vaarbewijs;

    function __construct(string $Iban, string $voorNaam, string $achterNaam, string $postCode, string $huisNummer, string $email, string $wachtwoord, int $telefoonNummer, string $geboorteDatum, bool $actief, string $huurderId, string $rijebwijs, string $vaarbewijs)
    {
        parent::__construct($Iban, $voorNaam, $achterNaam, $postCode, $huisNummer, $email, $wachtwoord, $telefoonNummer, $geboorteDatum, $actief);
        $this->huurderId = $huurderId;
        $this->rijebwijs = $rijebwijs;
        $this->vaarbewijs = $vaarbewijs;
    }


    public function getProperty($property)
    {
        return $this->$property;
    }
}
