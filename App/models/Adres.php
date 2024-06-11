<?php
namespace Models;

class Adres{
    private string $postcode;
    private string $huisnummer;
    private string $straatnaam;
    private string $plaats;
    private string $land;

    function __construct(string $postcode, string $huisnummer, string $straatnaam, string $plaats, string $land)
    {
        $this->postcode = $postcode;
        $this->huisnummer = $huisnummer;
        $this->straatnaam = $straatnaam;
        $this->plaats = $plaats;
        $this->land = 'Nederland';
    }

    public function getProperty($property)
    {
        return $this->$property;
    }

}