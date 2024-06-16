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

    // Returns the value of the property
    public function getProperty($property)
    {
        return $this->$property;
    }


    // Returns all boats from the database
    public static function getMany()
    {
        try {
            $db = Database::getInstance();
            $listingBoot = $db->query('SELECT * FROM boot INNER JOIN voertuig ON voertuig.VoertuigId = boot.BootId LIMIT 5;')->fetchAll();

            $boatsArray = [];
            // Loop through the fetched data and create a new Boat object for each row
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
            // Return the array of Boat objects
            return $boatsArray;
        } catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
    }

    // Returns all active boats from the database
    public static function getManyActief()
    {
        try {
            // Get an instance of the database
            $db = Database::getInstance();

            // Query to fetch active boats along with their corresponding voertuig data
            $listingBoot = $db->query(
                '
            SELECT * FROM boot 
            INNER JOIN voertuig ON voertuig.VoertuigId = boot.BootId 
            WHERE voertuig.Actief = 1 
            LIMIT 5;'
            )->fetchAll();

            $boatsArray = [];
            // Loop through the fetched data and create a new Boat object for each row
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
            // Return the array of Boat objects
            return $boatsArray;
        } catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
    }


    public static function getOne($boatId)
    {
        // Get an instance of the database
        try {
            $db = Database::getInstance();
            $boat = $db->query('SELECT * FROM boot 
                                INNER JOIN voertuig 
                                ON voertuig.VoertuigId = boot.BootId 
                                WHERE voertuig.VoertuigId = :id', ['id' => $boatId])->fetch();

            // If the boat exists, create a new Boat object and return it

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
        } catch (Exception $e) {
            // Log the error
            error_log($e->getMessage());
        }
    }

    // Add a new boat to the database
    public  function addBoat()
    {
        try {
            // Get an instance of the database
            $db = Database::getInstance();
            $db->query('START TRANSACTION');
            // Cast the value to an integer
            $actiefValue = ($this->actief === 'true') ? 1 : 0;
            // Insert the data into the voertuig table
            $db->query(
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

            // Cast the value to an integer
            $vaarBewijsValue = ($this->vaarBewijs === 'true') ? 1 : 0;

            // Get the last inserted id
            $boatId = $db->lastInsertId();
            $db->query(
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
            // If both inserts are successful, commit the transaction

            $db->query('COMMIT');

            // Return true if the transaction was successful
            return true;
        } catch (PDOException $e) {
            // Rollback the transaction if an error occurs
            $db->query('ROLLBACK');
            error_log($e->getMessage());
            // Return false if the transaction failed
            return false;
        }
    }


    // Returns all boats from the database
    public static function getManyByVerhuurderId($verhuurderId)
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
                                    WHERE gebruiker.Iban = :id', ['id' => $verhuurderId])->fetchAll();

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
        }
    }

    public function deleteBoat()
    {
        $db = Database::getInstance();
        $result = $db->query('DELETE FROM voertuig WHERE voertuigId = :id', ['id' => $this->voertuigId]);
    }


    public function updateBoat($updateValues)
    {
        try {
            $db = Database::getInstance();
            // Start a transaction because we have 2 inserts to make sure both are successful
            $db->query('START TRANSACTION');

            // cast the value to an integer
            $actiefValue = ($updateValues['actief'] === 'true') ? 1 : 0;

            // Update the voertuig table
            $db->query(
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


            // Update the boot table
            $db->query(
                'UPDATE boot SET Lengte = :Lengte, Breedte = :Breedte, TypeAandrijving = :Aandrijving, VaarBewijs = :VaarBewijs WHERE BootId = :BootId',
                [
                    'Lengte' => $updateValues['lengte'],
                    'Breedte' => $updateValues['breedte'],
                    'Aandrijving' => $updateValues['aandrijving'],
                    'VaarBewijs' => $vaarBewijsValue,
                    'BootId' => $updateValues['voertuigId']
                ]
            );

            // If both updates are successful, commit the transaction
            $db->query('COMMIT');
        } catch (PDOException $e) {

            // Rollback the transaction if an error occurs
            $db->query('ROLLBACK');
            error_log($e->getMessage());
        }
    }

    public static function searchModel($searchTerm1, $searchTerm2)
    {
        try {
            $db = Database::getInstance();
            // Query to fetch boats based on the search term
            $boat =  $db->query(
                'SELECT voertuig.VoertuigId, voertuig.OndernemingId, voertuig.Kleur, voertuig.Model, voertuig.Bouwjaar, voertuig.Zitplaatsen, voertuig.PrijsPerDag, voertuig.Actief,
                                boot.BootId, boot.Lengte, boot.Breedte, boot.TypeAandrijving, boot.Vaarbewijs
                                FROM voertuig
                                JOIN boot ON voertuig.VoertuigId = boot.BootId
                                WHERE (Model LIKE :searchTerm1 OR Kleur LIKE :searchTerm1)
                                AND (Bouwjaar LIKE :searchTerm2 OR Zitplaatsen LIKE :searchTerm1)',
                [
                    'searchTerm1' => '%' . $searchTerm1 . '%',
                    'searchTerm2' => '%' . $searchTerm2 . '%'
                ]
            )->fetchAll();

            $boatList = [];
            // Loop through the fetched data and create a new Boat object for each row
            foreach ($boat as $item) {
                $boatList[] = new Boat(
                    $item->VoertuigId,
                    $item->OndernemingId,
                    $item->Kleur,
                    $item->Model,
                    $item->Bouwjaar,
                    $item->Zitplaatsen,
                    $item->PrijsPerDag,
                    $item->Actief,
                    $item->BootId,
                    $item->Lengte,
                    $item->Breedte,
                    $item->TypeAandrijving,
                    $item->Vaarbewijs
                );
            }

            return $boatList;
        } catch (PDOException $e) {
            // Log the error
            error_log($e->getMessage());
            return []; // Return empty array or handle error as needed
        }
    }
}
