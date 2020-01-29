<?php

namespace Core\Kernel;

Class Kernel
{
    private $controllers;
    private $models;

    function __construct()
    {
        $app = dirname(__DIR__) . "/../App";

        $this->controllers = from(scandir($app."/Controllers/"))
            ->where('$classes ==> $classes != "." && $classes != ".."')
            ->toArray();

        $this->models = from(scandir($app."/Models/"))
            ->where('$classes ==> $classes != "." && $classes != ".."')
            ->toArray();
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