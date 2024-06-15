<?php

namespace Models;

use Exception;
use Models\Vehicle;
use Framework\Database;
use PDOException;

use function PHPUnit\Framework\isEmpty;

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

    public static function getManyActief() 
    {
        try {
            $db = Database::getInstance();
            $listingAuto = $db->query(
                'SELECT * FROM auto 
             INNER JOIN voertuig ON voertuig.VoertuigId = auto.AutoId 
             WHERE voertuig.Actief = 1
             LIMIT 5;'
            )->fetchAll();
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
         
        }
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
            
        }
    }


    public static function getManyByCarsId($id)
    {
        try {
            $db = Database::getInstance();
            $cars = $db->query('SELECT voertuig.VoertuigId, voertuig.OndernemingId, voertuig.Kleur, voertuig.Model, voertuig.Bouwjaar, voertuig.Zitplaatsen, voertuig.PrijsPerDag, voertuig.Actief,
                                auto.AutoId, auto.Kenteken, auto.KofferbakRuimte, auto.Dakrails, auto.Trekhaak, auto.Aandrijving
                                FROM gebruiker
                                JOIN verhuurder ON gebruiker.Iban = verhuurder.VerhuurderId
                                JOIN onderneming ON verhuurder.VerhuurderId = onderneming.VerhuurderId
                                JOIN voertuig ON onderneming.KVKNummer = voertuig.OndernemingId
                                JOIN auto ON voertuig.VoertuigId = auto.AutoId
                                WHERE gebruiker.Iban = :id', ['id' => $id])->fetchAll();

            $carList = [];
            foreach ($cars as $car) {
                $carList[] = new Car(
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

            return $carList;
        } catch (Exception $e) {
            error_log($e->getMessage());
            
        }
    }


    public function addCar()
    {

        try {
            // instance of the database
            $db = Database::getInstance();

            // start transaction
            $db->query('START TRANSACTION');
            $actiefValue = ($this->actief === 'true') ? 1 : 0;

            // insert the vehicle
            $voertuigInsert = $db->query(
                'INSERT INTO VOERTUIG (OndernemingId, Kleur, Model, Bouwjaar, Zitplaatsen, PrijsPerDag, Actief)
                                VALUES (:OndernemingId ,:Kleur, :Model, :Bouwjaar, :Zitplaatsen , :PrijsPerDag, :Actief )',
                [
                    'OndernemingId' => $this->ondernemingId,
                    'Kleur' => $this->kleur,
                    'Model' => $this->model,
                    'Bouwjaar' => $this->bouwjaar,
                    'Zitplaatsen' => $this->zitplaatsen,
                    'PrijsPerDag' => $this->prijsPerdag,
                    'Actief' => $actiefValue
                ]
            );

            // get the last inserted id
            $autoId = $db->lastInsertId();
            $trekhaakValue = ($this->trekhaak === 'true') ? 1 : 0;
            $dakrailsValue = ($this->dakrails === 'true') ? 1 : 0;
            // insert the car
            $autoInsert =  $db->query(
                'INSERT INTO AUTO (AutoId, Kenteken, KofferbakRuimte, Dakrails, Trekhaak, Aandrijving)
                                VALUES (:AutoId, :Kenteken, :KofferbakRuimte, :Dakrails, :Trekhaak, :Aandrijving)',
                [
                    'AutoId' => $autoId,
                    'Kenteken' => $this->kenteken,
                    'KofferbakRuimte' => $this->kofferbakRuimte,
                    'Dakrails' => $dakrailsValue,
                    'Trekhaak' => $trekhaakValue,
                    'Aandrijving' => $this->aandrijving
                ]
            );

            // commit the transaction
            if ($voertuigInsert && $autoInsert) {
                $db->query('COMMIT');
            }

            return $autoInsert;
        } catch (PDOException $e) {

            // return false if there is an error and log it
            $db->query('ROLLBACK');
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteOne($id)
    {
        $db = Database::getInstance();
        $result = $db->query('DELETE FROM voertuig WHERE voertuigId = :id', ['id' => $id]);
        return $result;
    }


    public function updateCar($updateValues)
    {
        try {
            $db = Database::getInstance();

            $db->query('START TRANSACTION');
            $actiefValue = ($updateValues['actief'] === 'true') ? 1 : 0;

            $voertuigUpdate = $db->query(
                'UPDATE voertuig SET Kleur = :Kleur, Model = :Model, Bouwjaar = :Bouwjaar, Zitplaatsen = :Zitplaatsen, PrijsPerDag = :PrijsPerDag,OndernemingId = :OndernemingId, Actief = :Actief WHERE VoertuigId = :VoertuigId',
                [
                    'Kleur' => $updateValues['kleur'],
                    'Model' => $updateValues['model'],
                    'Bouwjaar' => $updateValues['bouwjaar'],
                    'Zitplaatsen' => $updateValues['zitplaatsen'],
                    'VoertuigId' => $updateValues['voertuigId'],
                    'PrijsPerDag' => $updateValues['prijsPerDag'],
                    'OndernemingId' => $updateValues['optionsOnderneming'],
                    'Actief' => $actiefValue

                ]
            );
            $trekhaakValue = ($updateValues['trekhaak'] === 'true') ? 1 : 0;
            $dakrailsValue = ($updateValues['dakrails'] === 'true') ? 1 : 0;


            $autoUpdate = $db->query(
                'UPDATE auto SET Kenteken = :Kenteken, KofferbakRuimte = :KofferbakRuimte, Dakrails = :Dakrails, Trekhaak = :Trekhaak, Aandrijving = :Aandrijving WHERE AutoId = :AutoId',
                [
                    'Kenteken' => $updateValues['kenteken'],
                    'KofferbakRuimte' => $updateValues['kofferbakRuimte'],
                    'Dakrails' => $updateValues['dakrails'],
                    'Trekhaak' => $updateValues['trekhaak'],
                    'Aandrijving' => $updateValues['aandrijving'],
                    'AutoId' => $updateValues['autoId']
                ]
            );

            if ($voertuigUpdate && $autoUpdate) {
                $db->query('COMMIT');
            }

            return $autoUpdate;
        } catch (PDOException $e) {
            $db->query('ROLLBACK');
            error_log($e->getMessage());
            return false;
        }
    }


    public static function searchModel($searchTerm1, $searchTerm2)
    {
        try {
            $db = Database::getInstance();

   
            $cars =  $db->query('SELECT voertuig.VoertuigId, voertuig.OndernemingId, voertuig.Kleur, voertuig.Model, voertuig.Bouwjaar, voertuig.Zitplaatsen, voertuig.PrijsPerDag, voertuig.Actief,
                        auto.AutoId, auto.Kenteken, auto.KofferbakRuimte, auto.Dakrails, auto.Trekhaak, auto.Aandrijving
                      FROM voertuig
                      JOIN auto ON voertuig.VoertuigId = auto.AutoId
                      WHERE (Model LIKE :searchTerm1 OR Kleur LIKE :searchTerm1) AND (Bouwjaar LIKE :searchTerm2 OR Zitplaatsen LIKE :searchTerm1)', [
                'searchTerm1' => '%' . $searchTerm1 . '%',
                'searchTerm2' => '%' . $searchTerm2 . '%'
            ])->fetchAll();


            $carList = [];

            foreach ($cars as $car) {
                $carList[] = new Car(
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

            return $carList;
        } catch (PDOException $e) {

            error_log($e->getMessage());
        }
    }

    public function getProperty($property)
    {
        return $this->$property;
    }
}
