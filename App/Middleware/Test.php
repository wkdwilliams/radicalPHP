<?php

namespace App\Middleware;

class Test extends \Core\Middleware
{
    public function auth()
    {
        $this->next();
    }
}