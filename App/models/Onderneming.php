<?php

namespace Models;

use Framework\Database;
use PDOException;

class Onderneming
{

    private int $kvknummer;
    private string $onderneemingsnaam;
    private int $telefoonnummer;
    private string $postcode;
    private string $verhuurdersId;

    function __construct(int $kvknummer, string $onderneemingsnaam, int $telefoonnummer, string $postcode, string $verhuurdersId)
    {
        $this->kvknummer = $kvknummer;
        $this->onderneemingsnaam = $onderneemingsnaam;
        $this->telefoonnummer = $telefoonnummer;
        $this->postcode = $postcode;
        $this->verhuurdersId = $verhuurdersId;
    }

    public function getProperty($property)
    {
        return $this->$property;
    }
    public function getAllOndernemingByKVK($kvk)
    {

        try {
            $db = Database::getInstance();
            $user = $db->query('SELECT * FROM onderneming where KVKNummer = :KVKNummer', ['KVKNummer' => $kvk])->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $user;
    }

    public function addOnderneming()
    {
        try {
            $db = Database::getInstance();
            $db->query(
                'INSERT INTO onderneming 
                (KVKNummer, Ondernemingsnaam, Telefoonnummer, Postcode, VerhuurderId) 
                VALUES (:KVKNummer, :Ondernemingsnaam, :Telefoonnummer, :Postcode, :VerhuurderId)',
                [
                    'KVKNummer' => $this->kvknummer,
                    'Ondernemingsnaam' => $this->onderneemingsnaam,
                    'Telefoonnummer' => $this->telefoonnummer,
                    'Postcode' => $this->postcode,
                    'VerhuurderId' => $this->verhuurdersId
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}
