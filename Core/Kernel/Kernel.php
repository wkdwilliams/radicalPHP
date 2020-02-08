<?php

namespace Core\Kernel;

use \Core\Utils\Directory;

Class Kernel
{
    private array $controllers  = [];
    private array $models       = [];

    function __construct()
    {
        $app = dirname(__DIR__) . "/../App";

        foreach((new Directory($app."/Controllers/"))->getAllFiles() as $c)
            $this->controllers[] = str_replace(".php", "", $c);

        foreach((new Directory($app."/Models/"))->getAllFiles() as $m)
            $this->models[] = str_replace(".php", "", $m);
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