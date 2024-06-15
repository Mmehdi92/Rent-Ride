<?php

namespace Models;

use Framework\Database;
use PDOException;

class Zoekterm
{
    private int $id;
    private string $zoekterm;
    private string $created_at;

    function __construct(
        int $id,
        string $zoekterm,
        string $created_at
    ) {
        $this->id = $id;
        $this->zoekterm = $zoekterm;
        $this->created_at = $created_at;
    }



    public function getProperty($property)
    {
        return $this->$property;
    }

    public function addZoekterm($zoekterm)
    {
        try {
            $db = Database::getInstance();
            $db->query(
                'INSERT INTO zoektermen 
            (zoekterm) 
            VALUES (:zoekterm)',
                [
                    'zoekterm' => $zoekterm
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

public function deleteZoekterm($id)
    {
        try {
            $db = Database::getInstance();
            $result = $db->query('DELETE FROM zoektermen WHERE Id = :id', ['id' => $id]);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getOne($id)
    {
        try {
            $db = Database::getInstance();
            $zoektermData = $db->query('SELECT * FROM zoektermen WHERE Id = :id', ['id' => $id])->fetch();

            if (!$zoektermData) {
                return null;
            }

            return new Zoekterm(
                $zoektermData->Id,
                $zoektermData->Zoekterm,
                $zoektermData->Zoekdatum
            );
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }


    public static function getAllZoektermen()
    {
        try {
            $db = Database::getInstance();
            $searchTermList = $db->query('SELECT * FROM zoektermen')->fetchAll();

            $zoektermen = [];

            foreach ($searchTermList as $zoektermData) {
                $zoekterm = new Zoekterm(
                    $zoektermData->Id,
                    $zoektermData->Zoekterm,
                    $zoektermData->Zoekdatum
                );
                $zoektermen[] = $zoekterm;
            }

            return $zoektermen;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
}
