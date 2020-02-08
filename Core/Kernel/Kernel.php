<?php

namespace Core\Kernel;

use \Core\Utils\Directory;

Class Kernel
{
    private $controllers;
    private $models;

    function __construct()
    {
        $app = dirname(__DIR__) . "/../App";

        $this->controllers  = (new Directory($app."/Controllers/"))->getAllFiles();
        $this->models       = (new Directory($app."/Models/"))->getAllFiles();
    }

    public function command($command)
    {
        $command = new Command($this, $command);
        $command->execute();
    }

    /**
     * @return array
     */
    public function getControllers()
    {
        return $this->controllers;
    }

    /**
     * @return array
     */
    public function getModels()
    {
        return $this->models;
    }
}