
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
    string $kenteken,
    int $ondernemingId,
    string $kleur,
    string $model,
    bool $actief,
    int $kofferbakRuimte,
    float $prijsPerDag,
    int $zitplaatsen,
    bool $dakrails,
    bool $trekhaak,
    int $bouwjaar,

    ) {
        parent::__construct($voertuigId, $ondernemingId, $kleur, $model, $bouwjaar, $zitplaatsen, $actief, $prijsPerDag);
        $this->autoId = $voertuigId;
        $this->ondernemingId = $ondernemingId;
        $this->kleur = $kleur;
        $this->model = $model;
        $this->bouwjaar = $bouwjaar;
        $this->zitplaatsen = $zitplaatsen;
        $this->actief = $actief;
        $this->prijsPerDag = $prijsPerDag;
    }


    public function genericGetProperty($property)
    {
        return $this->$property;
    }


    public static function getMany()
    {
        $config = require basePath('config/db.php');
        $db = new Database($config);
        $listingAuto = $db->query('SELECT * FROM auto LEFT JOIN voertuig ON voertuig.voertuigId = auto.autoId;')->fetchAll();

        $carsArray = [];
        foreach ($listingAuto as $car) {
            inspect($car);
            $carsArray[] = new Car(
                $car->AutoId,
                $car->Kenteken,
                $car->VoertuigId,
                $car->OndernemingId,
                $car->Kleur,
                $car->Model,
                $car->Actief,
                $car->KofferbakRuimte,
                $car->PrijsPerDag,
                $car->Dakrails,
                $car->Trekhaak,
                $car->Bouwjaar
      
            );
        }
        return $carsArray;
    }
}
