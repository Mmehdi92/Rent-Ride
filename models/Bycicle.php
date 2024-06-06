<?php
require_once 'Vehicle.php';
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

        $config = require basePath('config/db.php');
        $db = new Database($config);

        $listingFiets = $db->query('SELECT * FROM fiets INNER JOIN voertuig on voertuig.VoertuigId = fiets.FietsId LIMIT 5 ;')->fetchAll();

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
    }

    
    public function getProperty($property)
    {
        return $this->$property;
    }
}
