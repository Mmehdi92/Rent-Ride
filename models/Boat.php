<?php
require_once 'Vehicle.php';
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
        $config = require basePath('config/db.php');
        $db = new Database($config);
        $listingBoot = $db->query('SELECT * FROM boot INNER JOIN voertuig on voertuig.VoertuigId = boot.BootId LIMIT 5;')->fetchAll();

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
    }
}
