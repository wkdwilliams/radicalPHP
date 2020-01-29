<?php


namespace Core\Kernel;

class Command
{

    private $command;
    private $kernel;

    function __construct(Kernel $kernel, string $command)
    {
        $this->kernel   = $kernel;
        $this->command  = strtolower($command);
    }

    public function execute()
    {

    }

}