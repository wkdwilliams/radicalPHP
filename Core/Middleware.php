<?php

namespace Core;

abstract class Middleware
{
    protected $route_params = [];

    function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    protected function next()
    {
        (new $this->route_params['controller'])->$this->route_params['action']();
    }
}