<?php 

abstract class Vehicle{

    protected int $voertuigId;
    protected int $ondernemingId;
    protected string $kleur;
    protected string $model;
    protected int $bouwjaar;
    protected int $zitplaatsen;
    protected float $prijsPerdag;
    protected bool $actief;


    function __construct(int $voertuigId, int $ondernemingId,
                            string $kleur, string $model, int $bouwjaar, 
                             int $zitplaatsen, float $prijsPerdag, bool $actief)
    {
        $this->voertuigId = $voertuigId;
        $this->ondernemingId = $ondernemingId;
        $this->kleur = $kleur;
        $this->model = $model;
        $this->bouwjaar = $bouwjaar;
        $this->zitplaatsen = $zitplaatsen;
        $this->prijsPerdag = $prijsPerdag;
        $this->actief = $actief;

    }
    

}



?>





