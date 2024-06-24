<?php

namespace Controllers;

use Exception;
use Models\CSVHandler;

class AboutController
{
 

    public function showAboutPage()
    {
        $csvFilePath = basePath('App/public/uploads/csv/csv.csv');
        $csvhandler = new CSVHandler($csvFilePath);
        try {
            $companyDetails = $csvhandler->getCompanyDetails();
            // Trim the keys to remove any leading/trailing spaces
            $companyDetails = array_combine(
                array_map('trim', array_keys($companyDetails)),
                $companyDetails
            );
            loadView('about/about', ['companyDetails' => $companyDetails ?? []]);
        } catch (Exception $e) {
            return $error[] = $e->getMessage();
        }
    }
}
