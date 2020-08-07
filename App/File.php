<?php

namespace App;

class File
{
    public static function validateFileInput($file)
    {
        $error = '';
        
        if ($file) {

            if (!file_exists($file['tmp_name'])) {

                $error = 'File input should not be empty.';
            }

            $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            
            if ($file_extension != 'csv') {

                $error = 'File is not supported. Please select .csv file.';
            }
        }

        return $error;
    }

    public static function convertCsvIntoArray($file) {

        $products = [];

        if (($h = fopen($file['tmp_name'], 'r')) !== FALSE) {

            while (($data = fgetcsv($h, 1000, ";")) !== FALSE) {

                $products[] = $data;		
            }

            fclose($h);
        }

        return $products;
    }
}
