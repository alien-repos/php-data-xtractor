<?php


class JsonToCsvConverter
{
    public function getJsonFile($filePath = 'test.json')
    {
        $dataInJson = file_get_contents($filePath);
    }

    public function jsonToCsvProcessor()
    {
        $dataInArray = json_decode($dataInJson);
    }

    public function createCsvFile($outFileName, $dataInArray)
    {
        fputcsv($outFileName, $dataInArray)
    }
}
