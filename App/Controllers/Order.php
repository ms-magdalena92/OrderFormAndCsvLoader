<?php

namespace App\Controllers;

use Core\View;

class Order extends \Core\Controller
{
    public function newAction()
    {
        View::renderTemplate('Order/new.html');
    }
}
