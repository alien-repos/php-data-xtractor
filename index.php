<?php

require_once __DIR__ . '/helpers.php';

class DataToInfo
{
    public function extractInfo($dirPath = 'text_files/*.txt')
    {
        $files = glob($dirPath);
        foreach ($files as $key => $file) {
            $dataString = $this->getTextFile($file);
            $dataInArray = $this->processData($dataString);
            // dd('dsfsdf');
            return $dataInArray;
            // $csvFiles[] = $this->createCsvFile($this->getOutFileName(), $dataInArray);
        }
    }

    public function getTextFile($filePath)
    {
        return file_get_contents($filePath);
    }

    public function processData($data)
    {
        return json_encode($this->extractUrlsFromString($data), JSON_FORCE_OBJECT);
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

    public function extractUrlsFromString($targetString)
    {
        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $targetString, $result);

        return $result[0];
    }

    public function getOutFileName()
    {
        return 'csv_files/' . date('dmyhis') . '.csv';
    }
}

$newObj = new DataToInfo();

echo $newObj->extractInfo();
