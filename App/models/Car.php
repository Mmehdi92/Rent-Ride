<?php

namespace Models;

use Exception;
use Models\Vehicle;
use Framework\Database;

class Car extends Vehicle
{

    private int $autoId;
    private string $kenteken;
    private int $kofferbakRuimte;
    private bool $dakrails;
    private bool $trekhaak;
    private string $aandrijving;

    function __construct(
        int $voertuigId,
        int $ondernemingId,
        string $kleur,
        string $model,
        int $bouwjaar,
        int $zitplaatsen,
        float $prijsPerdag,
        bool $actief,
        int $autoId,
        string $kenteken,
        int $kofferbakRuimte,
        bool $dakrails,
        bool $trekhaak,
        string $aandrijving
    ) {
        parent::__construct(
            $voertuigId,
            $ondernemingId,
            $kleur,
            $model,
            $bouwjaar,
            $zitplaatsen,
            $prijsPerdag,
            $actief
        );
        $this->autoId = $autoId;
        $this->kenteken = $kenteken;
        $this->kofferbakRuimte = $kofferbakRuimte;
        $this->dakrails = $dakrails;
        $this->trekhaak = $trekhaak;
        $this->aandrijving = $aandrijving;
    }


    public static function getMany()
    {
        try {
            $db = Database::getInstance();
            $listingAuto = $db->query('SELECT * FROM auto INNER JOIN voertuig ON voertuig.voertuigId = auto.autoId LIMIT 5;')->fetchAll();

            $carsArray = [];

            foreach ($listingAuto as $car) {
                $carsArray[] = new Car(
                    $car->VoertuigId,
                    $car->OndernemingId,
                    $car->Kleur,
                    $car->Model,
                    $car->Bouwjaar,
                    $car->Zitplaatsen,
                    $car->PrijsPerDag,
                    $car->Actief,
                    $car->AutoId,
                    $car->Kenteken,
                    $car->KofferbakRuimte,
                    $car->Dakrails,
                    $car->Trekhaak,
                    $car->Aandrijving
                );
            }

            return $carsArray;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
            return [];
        }
    }

    public static function getOne($id)
    {

        try {
            $db = Database::getInstance();
            $car = $db->query('SELECT * FROM auto 
                                INNER JOIN voertuig
                                ON
                                voertuig.voertuigId = auto.autoId
                                WHERE voertuig.voertuigId = :id;', ['id' => $id])->fetch();

            if ($car) {
                return new Car(
                    $car->VoertuigId,
                    $car->OndernemingId,
                    $car->Kleur,
                    $car->Model,
                    $car->Bouwjaar,
                    $car->Zitplaatsen,
                    $car->PrijsPerDag,
                    $car->Actief,
                    $car->AutoId,
                    $car->Kenteken,
                    $car->KofferbakRuimte,
                    $car->Dakrails,
                    $car->Trekhaak,
                    $car->Aandrijving
                );
            } else {
                return null;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function addCar()
    {

        try {
            $db = Database::getInstance();
            $db->query('START TRANSACTION');
            $voertuigInsert = $db->query(
                'INSERT INTO VOERTUIG (OndernemingId, Kleur, Model, Bouwjaar, Zitplaatsen, PrijsPerDag)
                                VALUES (:OndernemingId ,:Kleur, :Model, :Bouwjaar, :Zitplaatsen , :PrijsPerDag )',
                [
                    'OndernemingId' => $this->ondernemingId,
                    'Kleur' => $this->kleur,
                    'Model' => $this->model,
                    'Bouwjaar' => $this->bouwjaar,
                    'Zitplaatsen' => $this->zitplaatsen,
                    'PrijsPerDag' => $this->prijsPerdag
                ]
            );

            $autoId = $db->lastInsertId();


            $autoInsert =  $db->query(
                'INSERT INTO AUTO (AutoId, Kenteken, KofferbakRuimte, Dakrails, Trekhaak, Aandrijving)
                                VALUES (:AutoId, :Kenteken, :KofferbakRuimte, :Dakrails, :Trekhaak, :Aandrijving)',
                [
                    'AutoId' => $autoId,
                    'Kenteken' => $this->kenteken,
                    'KofferbakRuimte' => $this->kofferbakRuimte,
                    'Dakrails' => $this->dakrails,
                    'Trekhaak' => $this->trekhaak,
                    'Aandrijving' => $this->aandrijving
                ]
            );


            if ($voertuigInsert && $autoInsert) {
                $db->query('COMMIT');
            }
            
            return true;

        } catch (Exception $e) {

            $db->query('ROLLBACK');
            error_log($e->getMessage());
            return false;
        }
    }

    public function getProperty($property)
    {
        return $this->$property;
    }
}
