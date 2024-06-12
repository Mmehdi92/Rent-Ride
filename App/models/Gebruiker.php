<?php

namespace Models;



abstract class Gebruiker
{
    protected string $Iban;
    protected string $voorNaam;
    protected string $achterNaam;
    protected string $postCode;
    protected string $huisNummer;
    protected string $email;
    protected string $wachtwoord;
    protected int $telefoonNummer;
    protected string $geboorteDatum;
    protected bool $actief;

    function __construct(string $Iban, string $voorNaam, string $achterNaam, string $postCode, string $huisNummer, string $email, string $wachtwoord, int $telefoonNummer, string $geboorteDatum, bool $actief)
    {
        $this->Iban = $Iban;
        $this->voorNaam = $voorNaam;
        $this->achterNaam = $achterNaam;
        $this->postCode = $postCode;
        $this->huisNummer = $huisNummer;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
        $this->telefoonNummer = $telefoonNummer;
        $this->geboorteDatum = $geboorteDatum;
        $this->actief = $actief;
    }

    
}
