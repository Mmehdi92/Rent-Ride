<?php

namespace Models;
use Framework\Database;
use PDOException;

class Zoektermen
{
    private int $id;
    private string $zoekterm;
    function __construct(string $zoekterm)
    {
        $this->zoekterm = $zoekterm;
      
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
                    'zoekterm' => $this->zoekterm
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllZoektermen($id)
    {

        try {
            $db = Database::getInstance();
            $zoektermen = $db->query('SELECT * FROM zoektermen')->fetchAll();
            return $zoektermen;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}