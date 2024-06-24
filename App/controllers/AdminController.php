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
            loadView('dashboard/admin/listing/listing-searchTerms', ['errors' => ['Er zijn nog geen zoektermen']]);
        }

        loadview('dashboard/admin/listing/listing-searchTerms', [
            'searchTermList' => $searchTermList,
            'errors' => $errors
        ]);
    }

    public function deleteSearchTerm($params)
    {


        if (!isset($params['id'])) {
            ErrorController::notFound('Er is iets mis gegaan, probeer het opnieuw');
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

    public function showUpLoadPhoto()
    {

        loadView('dashboard/admin/upload/photo');
    }



    public function uploadPhoto()
    {

        // Directory where images will be uploaded
        $uploadDir = 'C:/laragon/RentAndRideWebApp/App/public/uploads/';

        // Full path of the uploaded file
        $uploadFile = $uploadDir . basename($_FILES['picture']['name']);

        // Flag to indicate if upload is okay (initially assume true)
        $uploadOk = 1;

        // Get the file extension of the uploaded file
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // Check if the form was submitted and the file was uploaded
        if (isset($_POST['submit'])) {
            // Check if the file is an actual image or a fake image
            $check = getimagesize($_FILES['picture']['tmp_name']);
            if ($check !== false) {
                echo 'File is an image - ' . $check['mime'] . '.';
                $uploadOk = 1; // Set uploadOk to 1 (true) indicating file is an image
            } else {
                echo 'File is not an image.';
                $uploadOk = 0; // Set uploadOk to 0 (false) indicating file is not an image
            }
        }

        // Check file size (if needed)
        // Example: Limit file size to 5MB
        if ($_FILES['picture']['size'] > 5 * 1024 * 1024) { // 5MB in bytes
            echo 'Sorry, your file is too large.';
            $uploadOk = 0; // Set uploadOk to 0 (false) indicating file size exceeded
        }

        // Allow only certain file formats
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
            $uploadOk = 0; // Set uploadOk to 0 (false) indicating unsupported file format
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo 'Sorry, your file was not uploaded.';
        } else { // If everything is okay, try to upload file
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
                redirect('/admin/upload');
                echo 'The file ' . basename($_FILES['picture']['name']) . ' has been uploaded.';
                // Here you can save the file path or perform other actions (e.g., database insertion)
                // Example: $filePath = $uploadFile;
            } else {
                echo 'Sorry, there was an error uploading your file.';
            }
        }
    }

    public function showCsvUpload()
    {
       
        loadView('dashboard/admin/csv/csv');
    }

    public function uploadCsv(){
        if ($_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
            // Directory where CSV files will be stored
            $uploadDir = 'C:/laragon/RentAndRideWebApp/App/public/uploads/';
    
            // Move uploaded file to the destination directory
            $csvFilePath = $uploadDir . $_FILES['csvFile']['name'];
            if (move_uploaded_file($_FILES['csvFile']['tmp_name'], $csvFilePath)) {
                // File uploaded successfully, process CSV data
    
                // Read CSV file data
                $csvData = array_map('str_getcsv', file($csvFilePath));
    
                // Example: Output CSV data for testing
                echo '<h2>Uploaded CSV Data:</h2>';
                echo '<pre>';
                print_r($csvData);
                echo '</pre>';
    
                // Optionally, process or save CSV data to database
    
                // Example: Redirect after successful upload (adjust URL as needed)
                header('Location: /admin-dashboard');
                exit;
            } else {
                // Failed to move uploaded file
                echo 'Failed to move uploaded file.';
            }
        } else {
            // Error occurred with file upload
            echo 'File upload error occurred.';
        }
    }
}
