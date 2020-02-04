<?php


namespace Core\Kernel;

class Command
{

    private string $command;
    private Kernel $kernel;

    private const UNRECOGNIZED_ERROR = "Unrecognized Command\n";
    private const CLASS_TEMPLATE     = "%3C%3Fphp%0A%0Anamespace%0A%0Ause".
                                        "%20%5CCore%5C%23%3B%0A%0Aclass".
                                        "%20%C2%A3%20extends%20%23%0A%7B%0A%0A%7D";

    function __construct(Kernel $kernel, string $command)
    {
        error_reporting(0);

        $this->kernel   = $kernel;
        $this->command  = $command;
    }

    public function execute()
    {
        $wordArray = explode(" ", $this->command);

        try {
            if($wordArray[0] == "create") {
                if ($wordArray[1] == "controller") {
                    $this->createController($wordArray[2]);
                    return;
                } else if ($wordArray[1] == "model") {
                    $this->createModel($wordArray[2]);
                    return;
                }
            }

            die(self::UNRECOGNIZED_ERROR);
        }
        catch(\Exception $e)
        {
            die(self::UNRECOGNIZED_ERROR);
        }
    }

    private function createController($name)
    {
        if(!isset($name)) die(self::UNRECOGNIZED_ERROR);

        $this->generateTemplate(true, $name);

        echo "Created Controller: $name\n";
    }

    private function createModel($name)
    {
        if(!isset($name)) die(self::UNRECOGNIZED_ERROR);

        $this->generateTemplate(false, $name);

        echo "Created Model: $name\n";
    }

    private function generateTemplate($isController, $name)
    {
        $class = str_replace("#", $isController ? "Controller" : "Model", urldecode(self::CLASS_TEMPLATE));
        $class = str_replace("namespace", "namespace App\\".($isController?"Controllers;":"Models;"), $class);
        $class = str_replace("£", $name, $class);

        file_put_contents(dirname(__FILE__) . "/../../App/".($isController?"Controllers":"Models")."/$name.php", $class);
    }

}