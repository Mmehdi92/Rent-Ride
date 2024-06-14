<?php
namespace Models;
use Framework\Database;
use PDOException;

class Reservering {
    private int $reserveringId;
    private string $startdatumtijd;
    private string $einddatumtijd;
    private string $status;
    private string $huurderId;
    private int $voertuigId;
    
    public function __construct(int $reserveringId, string $startdatumtijd, string $einddatumtijd, string $status,string $huurderId, int $voertuigId) {
        $this->reserveringId = $reserveringId;
        $this->startdatumtijd = $startdatumtijd;
        $this->einddatumtijd = $einddatumtijd;
        $this->status = $status;
        $this->huurderId = $huurderId;
        $this->voertuigId = $voertuigId;
    }

    public function getProperty(string $property) {
        return $this->$property;
    }

    public function  addReservering(){
        try{
            $db = Database::getInstance();
            $db->query('INSERT INTO reservering 
            (StartDatum, EindDatum, ReserveringStatus,HuurderId, VoertuigId) 
            VALUES 
            (:startdatumtijd, :einddatumtijd, :status, :huurderId, :voertuigId)', 
            ['startdatumtijd' => $this->startdatumtijd, 'einddatumtijd' => $this->einddatumtijd, 'status' => $this->status, 'voertuigId' => $this->voertuigId , 'huurderId' => $this->huurderId]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}