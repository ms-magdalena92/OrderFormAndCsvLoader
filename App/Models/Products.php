<?php

namespace App\Models;

use PDO;

class Products extends \Core\Model
{
    public $totalRecords = 0;
    public $invalidRecords = 0;
    
    public function __construct($data = [])
    {
        $this -> totalRecords = count($data) - 1;

        for($i = 1; $i < count($data); $i++) {

            if(count($data[$i]) != 6) {

                $this -> $invalidRecords ++;

            } else {

                $this -> products[$i - 1]['symbol'] = $data[$i][0];
                $this -> products[$i - 1]['name'] = $data[$i][1];
                $this -> products[$i - 1]['active'] = $data[$i][2];
                $this -> products[$i - 1]['author'] = $data[$i][3];
                $this -> products[$i - 1]['producer'] = $data[$i][4];
                $this -> products[$i - 1]['date'] = $data[$i][5];
            }
        }
    }
}
