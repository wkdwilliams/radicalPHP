<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;

class Home extends Controller
{

    public function indexAction()
    {
        View::renderTemplate('home.twig');
    }

    public function outputJSON()
    {
      return $this->response->json([
        "First Name" => "Lewis",
        "Last Name"  => "Williams"
      ]);
    }
}
