<?php

namespace Models;
use Exception;

class CSVHandler
{
    private string $filepath;
    private array $data;

    public function __construct(string $filepath = null)
    {
        $this->filepath = $filepath ?? '';
        $this->data = [];
    }

    public function uploadCsvFile($file)
    {
        // Set path to save the file
        $targetDir = basePath('App/public/uploads/csv/');
        $targetFile = $targetDir . basename($file['name']);
        $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);

        if ($fileType != 'csv') {
            throw new Exception("Aleen CSV Bestand Zijn toegestaan");
        }

        if ($file['error'] != 0) {
            throw new Exception("Er is een fout opgetreden tijdens het uploaden van het bestand");
        }

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $this->filepath = $targetFile;
        } else {
            throw new Exception("Er is een fout opgetreden tijdens het uploaden van het bestand");
        }
    }

    public function readCsvFile(): array
    {
        if (!file_exists($this->filepath)) {
            throw new Exception("CSV file not found");
        }

        $this->data = [];
        if (($handle = fopen($this->filepath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                $this->data[] = $row;
            }
            fclose($handle);
        } else {
            throw new Exception("Error opening the CSV file");
        }

        return $this->data;
    }

    public function getCompanyDetails(): array
    {
        $data = $this->readCsvFile();
        if (empty($data)) {
            throw new Exception("No data found in CSV file");
        }

        // Assuming the CSV has headers and the data starts from the second row
        $headers = $data[0];
        $companyDetails = $data[1];

        return array_combine($headers, $companyDetails);
    }
}
