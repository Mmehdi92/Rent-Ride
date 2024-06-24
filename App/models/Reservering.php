<?php

namespace Models;

use Framework\Database;
use PDOException;
use Interfaces\ReserveringInterface;

class Reservering implements ReserveringInterface
{
    private int $reserveringId;
    private string $startdatumtijd;
    private string $einddatumtijd;
    private string $status;
    private string $huurderId;
    private int $voertuigId;

    public function __construct(int $reserveringId, string $startdatumtijd, string $einddatumtijd, string $status, string $huurderId, int $voertuigId)
    {
        $this->reserveringId = $reserveringId;
        $this->startdatumtijd = $startdatumtijd;
        $this->einddatumtijd = $einddatumtijd;
        $this->status = $status;
        $this->huurderId = $huurderId;
        $this->voertuigId = $voertuigId;
    }

    public function getProperty(string $property)
    {
        return $this->$property;
    }

    public function  addReservering()
    {
        try {
            $db = Database::getInstance();
            $db->query(
                'INSERT INTO reservering 
            (StartDatum, EindDatum, ReserveringStatus,HuurderId, VoertuigId) 
            VALUES 
            (:startdatumtijd, :einddatumtijd, :status, :huurderId, :voertuigId)',
                ['startdatumtijd' => $this->startdatumtijd, 'einddatumtijd' => $this->einddatumtijd, 'status' => $this->status, 'voertuigId' => $this->voertuigId, 'huurderId' => $this->huurderId]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getManyReserveringByHuurderId($huurderId)
    {
        $db = Database::getInstance();
        $listingReservering = $db->query('SELECT * FROM reservering WHERE HuurderId = :huurderId', ['huurderId' => $huurderId])->fetchAll();
        $listingArray = [];
        foreach ($listingReservering as $reservering) {
            $listingArray[] = new Reservering(
                $reservering->ReserveringId,
                $reservering->StartDatum,
                $reservering->EindDatum,
                $reservering->ReserveringStatus,
                $reservering->HuurderId,
                $reservering->VoertuigId
            );
        }
        return $listingArray;
    }

    public static function getOneById($id)
    {
        $db = Database::getInstance();
        $reservering = $db->query('SELECT * FROM reservering WHERE ReserveringId = :reserveringId', ['reserveringId' => $id])->fetch();
        return new Reservering(
            $reservering->ReserveringId,
            $reservering->StartDatum,
            $reservering->EindDatum,
            $reservering->ReserveringStatus,
            $reservering->HuurderId,
            $reservering->VoertuigId
        );
    }

    public function deleteReservering($id)
    {
        try {
            $db = Database::getInstance();
            $db->query('DELETE FROM reservering WHERE ReserveringId = :reserveringId', ['reserveringId' => $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }

    public function  payReservering($id)
    {
        try {
            $db = Database::getInstance();
            $db->query('UPDATE reservering SET ReserveringStatus = "Completed" WHERE ReserveringId = :reserveringId', ['reserveringId' => $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }

    public function  cancelReservering($id)
    {
        try {
            $db = Database::getInstance();
            $db->query('UPDATE reservering SET ReserveringStatus = "Cancelled" WHERE ReserveringId = :reserveringId', ['reserveringId' => $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
}
