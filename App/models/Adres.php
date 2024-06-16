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

    public function  addAdres()
    {
        try {
            $db = Database::getInstance();
            $db->query(
                'INSERT INTO adres 
            (postcode, huisnummer, straatnaam, plaats, land) 
            VALUES (:postcode, :huisnummer, :straatnaam, :plaats, :land)',
                [
                    'postcode' => $this->postcode,
                    'huisnummer' => $this->huisnummer,
                    'straatnaam' => $this->straatnaam,
                    'plaats' => $this->plaats,
                    'land' => $this->land
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllAdresByPostcode($postcode, $huisnummer)
    {
        //returns  adressen Array 
        try {
            $db = Database::getInstance();
            $adressen = $db->query('SELECT * FROM adres where postcode = :postcode and huisnummer = :huisnummer', ['postcode' => $postcode, 'huisnummer' => $huisnummer])->fetchAll();
            foreach ($adressen as $adres) {
                $adressenArray[] = new Adres(
                    $adres->Postcode,
                    $adres->Huisnummer,
                    $adres->Straatnaam,
                    $adres->Plaats,
                    $adres->Land
                );
            }

            return $adressenArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
