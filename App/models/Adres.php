<?php

namespace Models;

use Framework\Database;
use PDOException;

class Adres
{
    private string $postcode;
    private string $huisnummer;
    private string $straatnaam;
    private string $plaats;
    private string $land;

    function __construct(string $postcode, string $huisnummer, string $straatnaam, string $plaats, string $land)
    {
        $this->setPostcode($postcode);
        $this->setHuisnummer($huisnummer);
        $this->setStraatnaam($straatnaam);
        $this->setPlaats($plaats);
        $this->setLand($land);
    }


    //setters
    private function setPostcode(string $postcode)
    {
        $this->postcode = $postcode;
    }

    private function setHuisnummer(string $huisnummer)
    {
        $this->huisnummer = $huisnummer;
    }

    private function setStraatnaam(string $straatnaam)
    {
        $this->straatnaam = $straatnaam;
    }

    private function setPlaats(string $plaats)
    {
        $this->plaats = $plaats;
    }

    private function setLand(string $land)
    {
        $this->land = $land;
    }

    public function getProperty($property)
    {
        return $this->{$property};
    }


//getters
    private function getPostcode()
    {
        return $this->postcode;
    }

    private function getHuisnummer()
    {
        return $this->huisnummer;
    }

    private function getStraatnaam()
    {
        return $this->straatnaam;
    }

    private function getPlaats()
    {
        return $this->plaats;
    }

    private function getLand()
    {
        return $this->land;
    }

    public function getAllAdresByPostcode($postcode, $huisnummer)
    {
        //returns  adressen Array 
        try {
            $db = Database::getInstance();
            $adressen = $db->query('SELECT * FROM adres where postcode = :postcode and huisnummer = :huisnummer', ['postcode' => $postcode, 'huisnummer' => $huisnummer])->fetchAll();
            $adressenArray = [];
            foreach ($adressen as $adres) {
                $adressenArray[] = new Adres(
                    $adres->getPostcode(),
                    $adres->getHuisnummer(),
                    $adres->getStraatnaam(),
                    $adres->getPlaats(),
                    $adres->getLand()
                );
            }

            return $adressenArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function addAdres()
    {
        try {
            $db = Database::getInstance();
            $db->query(
                'INSERT INTO adres (postcode, huisnummer, straatnaam, plaats, land) 
                 VALUES (:postcode, :huisnummer, :straatnaam, :plaats, :land)',
                [
                    'postcode' => $this->getPostcode(),
                    'huisnummer' => $this->getHuisnummer(),
                    'straatnaam' => $this->getStraatnaam(),
                    'plaats' => $this->getPlaats(),
                    'land' => $this->getLand()
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    // Add getter methods here for properties if they are not already implemented



}
