<?php

namespace App\Models;

use PDO;

class Products extends \Core\Model
{
    public $totalRecords = 0;
    public $addedProducts = 0;
    public $addedAuthors = 0;
    public $addedProducers = 0;
    public $addedDates = 0;
    
    public function __construct($data = [])
    {
        $this -> totalRecords = count($data) - 1;

        for($row = 1; $row < count($data); $row++) {

            if(count($data[$row]) == 6) {

                $i = $row - 1;
                $this -> products[$i]['symbol'] = $data[$row][0];
                $this -> products[$i]['name'] = $data[$row][1];
                $this -> products[$i]['active'] = $data[$row][2];
                $this -> products[$i]['author'] = $data[$row][3];
                $this -> products[$i]['producer'] = $data[$row][4];
                $this -> products[$i]['date'] = $data[$row][5];
            }
        }
    }

    public function saveProductsToDB()
    {
        foreach($this -> products as $product) {

            $this -> singleProduct = $product;

            if($this -> validateProductData()) {

                $this -> saveRecord();
            }
        }
    }

    protected function validateProductData()
    {
        if(!preg_match('/^[1-9][0-9]{12}$/', $this -> singleProduct['symbol'])) {

            return false;
        }

        if($this -> singleProduct['active'] != '' && !preg_match('/^[0-1]$/', $this -> singleProduct['active']) ) {

            return false;
        }

        if($this -> singleProduct['date'] != '' && !preg_match('/^[1-9][0-9]{3}$/', $this -> singleProduct['date'])) {

            return false;
        }

        return true;
    }

    protected function saveRecord()
    {
        if($this -> singleProduct['author'] != '' && !$this -> findAuthor()) {

            if($this -> saveNewAuthorToDB()) {
                
                $this -> addedAuthors ++;
            }
        }

        if($this -> singleProduct['producer'] != '' && !$this -> findProducer()) {

            if($this -> saveNewProducerToDB()) {

                $this -> addedProducers ++;
            }
        }

        if($this -> singleProduct['date'] != '' && !$this -> findDate()) {
            
            if($this -> saveNewDateToDB()) {

                $this -> addedDates ++;
            }
        }

        if($this -> singleProduct['symbol'] != '' && !$this -> findSymbol()) {
            
            if($this -> saveNewProductToDB()) {

                $this -> addedProducts ++;
            }
        }
    }

    protected function findAuthor()
    {
        $sql = 'SELECT * FROM author
                WHERE name = :name';
        
        $db = static::getDBconnection();

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':name', $this -> singleProduct['author'], PDO::PARAM_STR);
        $stmt -> execute();
        
        return $stmt -> fetch();
    }

    protected function saveNewAuthorToDB()
    {
        $sql = 'INSERT INTO author (name)
                VALUES (:name)';
        
        $db = static::getDBconnection();

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':name', $this -> singleProduct['author'], PDO::PARAM_STR);

        return $stmt -> execute();
    }

    protected function findProducer()
    {
        $sql = 'SELECT * FROM producer
                WHERE name = :name';
        
        $db = static::getDBconnection();

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':name', $this -> singleProduct['producer'], PDO::PARAM_STR);
        $stmt -> execute();
        
        return $stmt -> fetch();
    }

    protected function saveNewProducerToDB()
    {
        $sql = 'INSERT INTO producer (name)
                VALUES (:name)';
        
        $db = static::getDBconnection();

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':name', $this -> singleProduct['producer'], PDO::PARAM_STR);

        return $stmt -> execute();
    }

    protected function findDate()
    {
        $sql = 'SELECT * FROM publication_date
                WHERE year = :date';
        
        $db = static::getDBconnection();

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':date', (int)($this -> singleProduct['date']), PDO::PARAM_INT);
        $stmt -> execute();
        
        return $stmt -> fetch();
    }

    protected function findSymbol()
    {
        $sql = 'SELECT * FROM product
                WHERE symbol = :symbol';
        
        $db = static::getDBconnection();

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':symbol', $this -> singleProduct['symbol'], PDO::PARAM_STR);
        $stmt -> execute();
        
        return $stmt -> fetch();
    }

    protected function saveNewDateToDB()
    {
        $sql = 'INSERT INTO publication_date (year)
                VALUES (:date)';
        
        $db = static::getDBconnection();

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':date', (int)($this -> singleProduct['date']), PDO::PARAM_STR);

        return $stmt -> execute();
    }

    protected function saveNewProductToDB()
    {
        $sql = 'INSERT INTO product (symbol, name, active, author_id, producer_id, publication_date_id)
                VALUES (:symbol, :name, :active,
                (SELECT id FROM author
                WHERE name = :author_name),
                (SELECT id FROM producer
                WHERE name = :producer_name),
                (SELECT id FROM publication_date
                WHERE year = :date))';
        
        $db = static::getDBconnection();

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':symbol', $this -> singleProduct['symbol'], PDO::PARAM_STR);
        $stmt -> bindValue(':name', $this -> singleProduct['name'], PDO::PARAM_STR);
        $stmt -> bindValue(':active', $this -> singleProduct['active'], PDO::PARAM_INT);
        $stmt -> bindValue(':author_name', $this -> singleProduct['author'], PDO::PARAM_STR);
        $stmt -> bindValue(':producer_name', $this -> singleProduct['producer'], PDO::PARAM_STR);
        $stmt -> bindValue(':date', $this -> singleProduct['date'], PDO::PARAM_INT);

        return $stmt -> execute();
    }
}
