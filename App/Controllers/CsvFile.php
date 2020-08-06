<?php

namespace App\Controllers;

use Core\View;
use \App\Models\Products;

class CsvFile extends \Core\Controller
{
    public function uploadAction()
    {
        View::renderTemplate('File/upload.html');
    }
}
