<?php

namespace App\Models;

class Items
{
    public $validationErrors = [];
    
    public function __construct($data = [])
    {
        foreach($data as $key => $value) {
            
            $this -> $key = $value;
        };
    }
    
    public function validateForm()
    {
        if(isset($this -> name)) {
            
            if($this -> name == '') {
                
                $this -> validationErrors['name'] = 'This field is required.';
            }
            
            else if(!preg_match('/^[A-Za-z]+$/', $this -> name)) {
                
                $this -> validationErrors['name'] = 'Name must contain letters only.';
            }
        }

        if(isset($this -> phone)) {
            
            if($this -> phone == '') {
                
                $this -> validationErrors['phone'] = 'This field is required.';
            }
            
            else if(!preg_match('/^[0-9\+]{8,13}$/', $this -> phone)) {
                
                $this -> validationErrors['phone'] = 'Enter valid phone number.';
            }
        }

        if(isset($this -> email)) {

            if($this -> email == '') {
                
                $this -> validationErrors['email'] = 'This field is required.';
            }
            
            else if(!filter_var($this -> email, FILTER_VALIDATE_EMAIL) || filter_var($this -> email, FILTER_SANITIZE_EMAIL) != $this -> email) {
                
                $this -> validationErrors['email'] = 'Please enter a valid e-mail adress.';
            }
        }

        if(isset($this -> productName)) {

            for ($i = 0; $i < count($this -> productName); $i++) {
                
                if($this -> productName[$i] == '') {
                
                    $this -> validationErrors['productName'.$i] = 'This field is required.';
                }
                
                else if(!preg_match('/^[A-Za-z0-9]+$/', $this -> productName[$i])) {
                    
                    $this -> validationErrors['productName'.$i] = 'Product name must contain letters and numbers only.';
                }
            }
        }

        if(isset($this -> quantity)) {

            for ($i = 0; $i < count($this -> quantity); $i++) {
                
                if($this -> quantity[$i] == '') {
                
                    $this -> validationErrors['quantity'.$i] = 'This field is required.';

                }

                else if(!is_numeric($this -> quantity[$i]) || !preg_match('/^[0-9]+$/', $this -> quantity[$i]) || $this -> quantity[$i] < 1) {
                    
                    $this -> validationErrors['quantity'.$i] = 'Please enter positive integer.';
                }
            }
        }

        if(isset($this -> unitPrice)) {

            for ($i = 0; $i < count($this -> unitPrice); $i++) {
                
                if($this -> unitPrice[$i] == '') {
                
                    $this -> validationErrors['unitPrice'.$i] = 'This field is required.';
                }
                
                else if(!is_numeric($this -> unitPrice[$i]) || !preg_match('/^\d+(,\d{3})*(\.\d{1,2})?$/', $this -> unitPrice[$i])) {
                    
                    $this -> validationErrors['unitPrice'.$i] = 'Please enter valid positive number.';
                }
            }
        }

        if(empty($this -> validationErrors)) {

            return true;
        }

        return false;
    }
}
