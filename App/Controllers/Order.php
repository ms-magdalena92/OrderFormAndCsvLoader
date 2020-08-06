<?php

namespace App\Controllers;

use Core\View;
use \App\Models\Items;

class Order extends \Core\Controller
{
    public function newAction()
    {
        View::renderTemplate('Order/new.html');
    }

    public function createAction()
    {
        $items = new Items($_POST);

        if($items -> validateForm()) {
            
            View::renderTemplate('Order/summary.html', ['items' => $items]);
            
        } else {
            
            View::renderTemplate('Order/new.html', ['items' => $items]);
        }
    }
}
