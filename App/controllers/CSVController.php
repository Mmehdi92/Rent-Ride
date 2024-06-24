<?php

namespace Controllers;

use Exception;
use Framework\Session;
use Models\CSVHandler;

class CSVController
{
    /**
     * Handle CSV file upload
     */
    public function uploadCsv()
    {
        // Create a new instance of CSVHandler
        $csvhandler = new CSVHandler();

        try {
            // Call method to upload CSV file from $_FILES['csvfile']
            $csvhandler->uploadCsvFile($_FILES['csvfile']);

            // Set success message in session
            Session::set('succes_message', 'CSV file uploaded successfully ✅');

            // Redirect to /admin/csv route after successful upload
            redirect('/admin/csv');
        } catch (Exception $e) {
            // If an exception occurs during upload, catch it
            // and return an array with the error message
            return $error[] = $e->getMessage();
        }
    }


}

