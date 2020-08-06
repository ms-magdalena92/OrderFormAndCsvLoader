<?php

namespace App\Controllers;

use Core\View;
use \App\File;

class CsvFile extends \Core\Controller
{
    public function uploadAction()
    {
        View::renderTemplate('File/upload.html');
    }

    public function readAction()
    {
        $inputValidationError = File::validateFileInput($_FILES['csvFile']);

        if($inputValidationError == '') {

            $productsArray = File::convertCsvIntoArray($_FILES['csvFile']);

            if (!empty($productsArray)) {

                

            } else {

                View::renderTemplate('File/upload.html', ['fileError' => 'Cannot read the file. Please try again or check if the file is valid.']);
            }

        } else {

            View::renderTemplate('File/upload.html', ['inputError' => $inputValidationError]);
        }

    }
}
