<?php
abstract class Vehicle {
    protected int $voertuigId;
    protected int $ondernemingId;
    protected string $kleur;
    protected string $model;
    protected int $bouwjaar;
    protected int $zitplaatsen;
    protected bool $actief;
    protected float $prijsPerDag;

    function __construct(
        int $voertuigId,
        int $ondernemingId,
        string $kleur,
        string $model,
        int $bouwjaar,
        int $zitplaatsen,
        bool $actief,
        float $prijsPerDag
    ) {
        $this->voertuigId = $voertuigId;
        $this->ondernemingId = $ondernemingId;
        $this->kleur = $kleur;
        $this->model = $model;
        $this->bouwjaar = $bouwjaar;
        $this->zitplaatsen = $zitplaatsen;
        $this->actief = $actief;
        $this->prijsPerDag = $prijsPerDag;
    }

    
}
?>