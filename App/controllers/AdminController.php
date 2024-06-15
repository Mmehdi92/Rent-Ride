<?php

namespace Controllers;


use Models\Zoekterm;

class AdminController
{
    public function showSearchTermList()
    {
        $searchTermList = Zoekterm::getAllZoektermen();

        $errors = [];
    
        if (!$searchTermList) {
            loadView('dashboard/admin/listing/listing-searchTerms', ['errors' => ['Geen zoektermen gevonden']]);
        }

        loadview('dashboard/admin/listing/listing-searchTerms', [
            'searchTermList' => $searchTermList,
            'errors' => $errors
        ]);
    }

    public function deleteSearchTerm($params)
    {

   
        if (!isset($params['id'])) {
            ErrorController::notFound('Car not found');
            exit;
        }


        $id = $params['id'];
        $zoekterm = Zoekterm::getOne($id);
        if (!isset($zoekterm)) {
            ErrorController::notFound('Zoekterm not found');
            return;
        }
        
        
        $result = $zoekterm->deleteZoekterm($id);
  
        if ($result) {
            // Set flash message
            $_SESSION['succes_message'] = ' Zoekterm succesvol verwijderd ✅    ';
            redirect('/listing-searchterms');
        } else {
            ErrorController::notFound('Zoekterm not Deleted');
        }
    }
}
