<?php

require_once __DIR__ . '/helpers.php';

class JsonToCsvConverter
{
    public function __construct($dirPath = 'json_files/*.json')
    {
        $files = glob($dirPath);
        foreach ($files as $key => $file) {
            $jsonString = $this->getJsonFile($file);
            $dataInArray = $this->jsonToArrayProcessor($jsonString);
            $csvFiles[] = $this->createCsvFile($this->getOutFileName(), $dataInArray);
        }
    }

    public function getJsonFile($filePath)
    {
        return file_get_contents($filePath);
    }

    public function jsonToArrayProcessor($dataInJson)
    {
        return json_decode($dataInJson, true);
    }

    public function createCsvFile($outFileName, $dataInArray)
    {
        $outFileName = fopen($outFileName, 'w');
        
        foreach ($dataInArray as $key => $value) {
            fputcsv($outFileName, $value);
        }

        fclose($outFileName);

        return $outFileName;
    }

    public function getOutFileName()
    {
        return 'csv_files/' . date('dmyhis') . 'csv';
    }
}

$newObj = new JsonToCsvConverter();
