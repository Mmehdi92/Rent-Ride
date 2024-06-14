<?php

namespace Models;

use Exception;
use Models\Vehicle;
use Framework\Database;
use PDOException;

class Boat extends Vehicle
{

    private int $bootId;
    private float $lengte;
    private float $breedte;
    private string $aandrijving;
    private bool $vaarBewijs;

    function __construct(
        int $voertuigId,
        int $ondernemingId,
        string $kleur,
        string $model,
        int $bouwjaar,
        int $zitplaatsen,
        float $prijsPerdag,
        bool $actief,
        int $bootId,
        float $lengte,
        float $breedte,
        string $aandrijving,
        bool $vaarBewijs
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

        $this->bootId = $bootId;
        $this->lengte = $lengte;
        $this->breedte = $breedte;
        $this->aandrijving = $aandrijving;
        $this->vaarBewijs = $vaarBewijs;
    }


    public function getProperty($property)
    {
        return $this->$property;
    }



    public static function getMany()
    {
        try {
            $db = Database::getInstance();
            $listingBoot = $db->query('SELECT * FROM boot INNER JOIN voertuig ON voertuig.VoertuigId = boot.BootId LIMIT 5;')->fetchAll();

            $boatsArray = [];

            foreach ($listingBoot as $boat) {
                $boatsArray[] = new Boat(
                    $boat->VoertuigId,
                    $boat->OndernemingId,
                    $boat->Kleur,
                    $boat->Model,
                    $boat->Bouwjaar,
                    $boat->Zitplaatsen,
                    $boat->PrijsPerDag,
                    $boat->Actief,
                    $boat->BootId,
                    $boat->Lengte,
                    $boat->Breedte,
                    $boat->TypeAandrijving,
                    $boat->Vaarbewijs
                );
            }

            return $boatsArray;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
            return [];
        }
    }
    public static function getManyActief()
{
    try {
        $db = Database::getInstance();

        // Query to fetch active boats along with their corresponding voertuig data
        $listingBoot = $db->query('
            SELECT * FROM boot 
            INNER JOIN voertuig ON voertuig.VoertuigId = boot.BootId 
            WHERE voertuig.Actief = 1 
            LIMIT 5;'
        )->fetchAll();

        $boatsArray = [];

        foreach ($listingBoot as $boat) {
            $boatsArray[] = new Boat(
                $boat->VoertuigId,
                $boat->OndernemingId,
                $boat->Kleur,
                $boat->Model,
                $boat->Bouwjaar,
                $boat->Zitplaatsen,
                $boat->PrijsPerDag,
                $boat->Actief,
                $boat->BootId,
                $boat->Lengte,
                $boat->Breedte,
                $boat->TypeAandrijving,
                $boat->Vaarbewijs
            );
        }

        return $boatsArray;
    } catch (Exception $e) {
        error_log($e->getMessage());
        throw $e;
    }
}


    public static function getOne($id)
    {
        try {
            $db = Database::getInstance();
            $boat = $db->query('SELECT * FROM boot 
                                INNER JOIN voertuig 
                                ON voertuig.VoertuigId = boot.BootId 
                                WHERE voertuig.VoertuigId = :id', ['id' => $id])->fetch();

            if ($boat) {
                return new Boat(
                    $boat->VoertuigId,
                    $boat->OndernemingId,
                    $boat->Kleur,
                    $boat->Model,
                    $boat->Bouwjaar,
                    $boat->Zitplaatsen,
                    $boat->PrijsPerDag,
                    $boat->Actief,
                    $boat->BootId,
                    $boat->Lengte,
                    $boat->Breedte,
                    $boat->TypeAandrijving,
                    $boat->Vaarbewijs
                );
            } else {
                return null;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }


    public  function addBoat()
    {
        try {
            $db = Database::getInstance();
            $db->query('START TRANSACTION');

            $actiefValue = ($this->actief === 'true') ? 1 : 0;

            $voertuigInsert = $db->query(
                'INSERT INTO VOERTUIG (OndernemingId, Kleur, Model, Bouwjaar, Zitplaatsen, PrijsPerDag, Actief)
                    VALUES (:OndernemingId ,:Kleur, :Model, :Bouwjaar, :Zitplaatsen , :PrijsPerDag , :Actief)',
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
            $vaarBewijsValue = ($this->vaarBewijs === 'true') ? 1 : 0;
            $boatId = $db->lastInsertId();
            $boatInsert = $db->query(
                'INSERT INTO BOOT (BootId, Lengte, Breedte, TypeAandrijving, Vaarbewijs)
                    VALUES (:BootId, :Lengte, :Breedte, :TypeAandrijving, :Vaarbewijs)',
                [
                    'BootId' => $boatId,
                    'Lengte' => $this->lengte,
                    'Breedte' => $this->breedte,
                    'TypeAandrijving' => $this->aandrijving,
                    'Vaarbewijs' => $vaarBewijsValue
                ]
            );

            if ($voertuigInsert && $boatInsert) {
                $db->query('COMMIT');
            }
            return $boatInsert;
        } catch (PDOException $e) {
            $db->query('ROLLBACK');
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getManyByBoatsId($id)
    {
        try {
            $db = Database::getInstance();
            $boats = $db->query('SELECT voertuig.VoertuigId, voertuig.OndernemingId, voertuig.Kleur, voertuig.Model, voertuig.Bouwjaar, voertuig.Zitplaatsen, voertuig.PrijsPerDag, voertuig.Actief,
                                    boot.BootId, boot.Lengte, boot.Breedte, boot.TypeAandrijving, boot.Vaarbewijs
                                    FROM gebruiker
                                    JOIN verhuurder ON gebruiker.Iban = verhuurder.VerhuurderId
                                    JOIN onderneming ON verhuurder.VerhuurderId = onderneming.VerhuurderId
                                    JOIN voertuig ON onderneming.KVKNummer = voertuig.OndernemingId
                                    JOIN boot ON voertuig.VoertuigId = boot.BootId
                                    WHERE gebruiker.Iban = :id', ['id' => $id])->fetchAll();

            $boatList = [];
            foreach ($boats as $boat) {
                $boatList[] = new Boat(
                    $boat->VoertuigId,
                    $boat->OndernemingId,
                    $boat->Kleur,
                    $boat->Model,
                    $boat->Bouwjaar,
                    $boat->Zitplaatsen,
                    $boat->PrijsPerDag,
                    $boat->Actief,
                    $boat->BootId,
                    $boat->Lengte,
                    $boat->Breedte,
                    $boat->TypeAandrijving,
                    $boat->Vaarbewijs
                );
            }

            return $boatList;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function deleteBoat()
    {
        $db = Database::getInstance();
        $result = $db->query('DELETE FROM voertuig WHERE voertuigId = :id', ['id' => $this->voertuigId]);
        return $result;
    }


    public function updateBoat($updateValues)
    {
        try {
            $db = Database::getInstance();
    
            $db->query('START TRANSACTION');
        $actiefValue = ($updateValues['actief'] === 'true') ? 1 : 0;
            // Update the voertuig table
            $voertuigUpdate = $db->query(
                'UPDATE voertuig SET Kleur = :Kleur, Model = :Model, Bouwjaar = :Bouwjaar, Zitplaatsen = :Zitplaatsen, PrijsPerDag = :PrijsPerDag, OndernemingId = :OndernemingId, Actief = :Actief WHERE VoertuigId = :VoertuigId',
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
            // cast the value to an integer
            $vaarBewijsValue = ($updateValues['vaarbewijs'] === 'true') ? 1 : 0;

            $bootUpdate = $db->query(
                'UPDATE boot SET Lengte = :Lengte, Breedte = :Breedte, TypeAandrijving = :Aandrijving, VaarBewijs = :VaarBewijs WHERE BootId = :BootId',
                [
                    'Lengte' => $updateValues['lengte'],
                    'Breedte' => $updateValues['breedte'],
                    'Aandrijving' => $updateValues['aandrijving'],
                    'VaarBewijs' => $vaarBewijsValue,
                    'BootId' => $updateValues['voertuigId']
                ]
            );
    
            if ($voertuigUpdate && $bootUpdate) {
                $db->query('COMMIT');
            } else {
                $db->query('ROLLBACK');
                return false;
            }
    
            return $bootUpdate;
        } catch (PDOException $e) {
            $db->query('ROLLBACK');
            error_log($e->getMessage());
            return false;
        }
    }
    

}
