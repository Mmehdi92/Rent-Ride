<?php

namespace Models;

use Framework\Database;
use PDOException;

class Onderneming
{

    private int $kvknummer;
    private string $ondernemingsnaam;
    private int $telefoonnummer;
    private string $huisnummer;
    private string $postcode;
    private string $verhuurdersId;

    function __construct(int $kvknummer, string $ondernemingsnaam, int $telefoonnummer, string $huisnummer, string $postcode, string $verhuurdersId)
    {
        $this->kvknummer = $kvknummer;
        $this->ondernemingsnaam = $ondernemingsnaam;
        $this->telefoonnummer = $telefoonnummer;
        $this->huisnummer = $huisnummer;
        $this->postcode = $postcode;
        $this->verhuurdersId = $verhuurdersId;
    }

    public function getProperty($property)
    {
        return $this->$property;
    }

    public  function getAllOndernemingByKVK($kvk)
    {

        try {
            $db = Database::getInstance();
            $onderneming = $db->query('SELECT * FROM onderneming where KVKNummer = :KVKNummer', ['KVKNummer' => $kvk])->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $onderneming;
    }


    public static function getAllOndernemingByVerhuurdersId($verhuurdersId)
    {

        try {
            $db = Database::getInstance();
            $ondernemingen = $db->query('SELECT * FROM onderneming where VerhuurderId = :verhuurdersId', ['verhuurdersId' => $verhuurdersId])->fetchAll();
            $ondermingenArray = [];
            foreach ($ondernemingen as $onderneming) {
                $ondermingenArray[] = new Onderneming(
                    $onderneming->KVKNummer,
                    $onderneming->Ondernemingsnaam,
                    $onderneming->Telefoonnummer,
                    $onderneming->Huisnummer,
                    $onderneming->Postcode,
                    $onderneming->VerhuurderId
                );
            }
            return $ondermingenArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addOnderneming()
    {
        try {
            $db = Database::getInstance();
            $db->query(
                'INSERT INTO onderneming 
                (KVKNummer, Ondernemingsnaam, Telefoonnummer,Huisnummer, Postcode, VerhuurderId) 
                VALUES (:KVKNummer, :Ondernemingsnaam, :Telefoonnummer,:Huisnummer, :Postcode, :VerhuurderId)',
                [
                    'KVKNummer' => $this->kvknummer,
                    'Ondernemingsnaam' => $this->ondernemingsnaam,
                    'Telefoonnummer' => $this->telefoonnummer,
                    'Huisnummer' => $this->huisnummer,
                    'Postcode' => $this->postcode,
                    'VerhuurderId' => $this->verhuurdersId
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public static function getOne($kvkNummer)
    {
        try {
            $db = Database::getInstance();
            $onderneming = $db->query('SELECT * FROM onderneming where KVKNummer = :KVKNummer', ['KVKNummer' => $kvkNummer])->fetch();
            if ($onderneming) {
                return new Onderneming(
                    $onderneming->KVKNummer,
                    $onderneming->Ondernemingsnaam,
                    $onderneming->Telefoonnummer,
                    $onderneming->Huisnummer,
                    $onderneming->Postcode,
                    $onderneming->VerhuurderId
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteOne($kvkNummer)
    {
        $db = Database::getInstance();
        $result = $db->query('DELETE FROM onderneming WHERE KVKNummer = :kvkNummer', ['kvkNummer' => $kvkNummer]);
        return $result;
    }

    public function getFullOndernemingsAdres($postcode, $huisnummer)
    {
        try {
            $db = Database::getInstance();
            $ondernemingsAdres = $db->query('SELECT * FROM adres WHERE Postcode = :postcode AND Huisnummer = :huisnummer', ['postcode' => $postcode, 'huisnummer' => $huisnummer])->fetch();
            if (!$ondernemingsAdres) {
                return null;
            } else {
                return new Adres(
                    $ondernemingsAdres->Postcode,
                    $ondernemingsAdres->Huisnummer,
                    $ondernemingsAdres->Straatnaam,
                    $ondernemingsAdres->Plaats,
                    $ondernemingsAdres->Land
                );
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateOnderneming($updateValues){
        try {
            $db = Database::getInstance();
            $result = $db->query('UPDATE onderneming SET Ondernemingsnaam = :Ondernemingsnaam, Telefoonnummer = :Telefoonnummer, Huisnummer = :Huisnummer, Postcode = :Postcode WHERE KVKNummer = :KVKNummer', [
                'Ondernemingsnaam' => $updateValues['ondernemingsnaam'],
                'Telefoonnummer' => $updateValues['telefoonnummer'],
                'Huisnummer' => $updateValues['huisnummer'],
                'Postcode' => $updateValues['postcode'],
                'KVKNummer' => $updateValues['kvkNummer']
            ]);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
