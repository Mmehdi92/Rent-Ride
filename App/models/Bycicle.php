<?php
namespace Models;
use Exception;
use Models\Vehicle;
use Framework\Database;
class Bycicle extends Vehicle
{
    private int $fietsId;
    private int $versnelling;
    private bool $elektrisch;
    private string $typeFiets;
    private string $remType;

    function __construct(
        int $voertuigId,
        int $ondernemingId,
        string $kleur,
        string $model,
        int $bouwjaar,
        int $zitplaatsen,
        float $prijsPerdag,
        bool $actief,
        int $fietsId,
        int $versnelling,
        bool $elektrisch,
        string $typeFiets,
        string $remType
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
        $this->fietsId = $fietsId;
        $this->versnelling = $versnelling;
        $this->elektrisch = $elektrisch;
        $this->typeFiets = $typeFiets;
        $this->remType = $remType;
    }
    
    public static function getMany()
    {
        try {
            $db = Database::getInstance();
            $listingFiets = $db->query('SELECT * FROM fiets INNER JOIN voertuig ON voertuig.VoertuigId = fiets.FietsId LIMIT 5;')->fetchAll();

            $fietsArray = [];

            foreach ($listingFiets as $fiets) {
                $fietsArray[] = new Bycicle(
                    $fiets->VoertuigId,
                    $fiets->OndernemingId,
                    $fiets->Kleur,
                    $fiets->Model,
                    $fiets->Bouwjaar,
                    $fiets->Zitplaatsen,
                    $fiets->PrijsPerDag,
                    $fiets->Actief,
                    $fiets->FietsId,
                    $fiets->Versnelling,
                    $fiets->Elektrische,
                    $fiets->Type,
                    $fiets->RemType
                );
            }

            return $fietsArray;
        } catch (Exception $e) {
            error_log($e->getMessage());
        
        }
    }

    public static function getOne($id)
    {
        try {
            $db = Database::getInstance();
            $fiets = $db->query('SELECT * FROM fiets 
                                INNER JOIN voertuig 
                                ON voertuig.VoertuigId = fiets.FietsId 
                                WHERE voertuig.VoertuigId = :id', ['id' => $id])->fetch();

            if ($fiets) {
                return new Bycicle(
                    $fiets->VoertuigId,
                    $fiets->OndernemingId,
                    $fiets->Kleur,
                    $fiets->Model,
                    $fiets->Bouwjaar,
                    $fiets->Zitplaatsen,
                    $fiets->PrijsPerDag,
                    $fiets->Actief,
                    $fiets->FietsId,
                    $fiets->Versnelling,
                    $fiets->Elektrische,
                    $fiets->Type,
                    $fiets->RemType
                );
            } else {
                return null;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        
        }
    }


    public function getProperty($property)
    {
        return $this->$property;
    }
}
