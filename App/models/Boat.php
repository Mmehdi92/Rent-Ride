<?php
namespace Models;
use Exception;
use Models\Vehicle;
use Framework\Database;
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

    public static function getOne( $id)
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
}
