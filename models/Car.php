<?php
require_once 'Vehicle.php';
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
        $config = require basePath('config/db.php');
        $db = new Database($config);
        $listingAuto = $db->query(' SELECT * FROM auto INNER JOIN voertuig ON voertuig.voertuigId = auto.autoId limit 5;')->fetchAll();
        inspect($listingAuto);
        $carsArray = [];
        foreach ($listingAuto as $car) {
            inspect($car);
            $carsArray[] = new Car(
                $car->VoertuigId,  // voertuigId
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
    }



    public function getProperty($property)
    {
        return $this->$property;
    }
}
