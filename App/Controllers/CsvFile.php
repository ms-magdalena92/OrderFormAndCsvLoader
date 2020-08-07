<?php

namespace App\Controllers;

use Core\View;
use \App\File;
use \App\Models\Products;

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

            if (count($productsArray)) {

                $products = new Products($productsArray);

                $products -> saveProductsToDB();

                View::renderTemplate('File/upload.html', ['products' => $products]);
            }
            else if (count($productsArray) == 0) {
                
                View::renderTemplate('File/upload.html', ['fileError' => 'Selected file is empty.']);
            }
            else {

                View::renderTemplate('File/upload.html', ['fileError' => 'Cannot read the file. Please try again or check if the file is valid.']);
            }

        } else {

            View::renderTemplate('File/upload.html', ['inputError' => $inputValidationError]);
        }

    }
}
