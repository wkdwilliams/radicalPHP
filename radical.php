<?php

use Core\Kernel\Kernel;

require __DIR__ . '/vendor/autoload.php';

if(count($argv) == 1)
{
    echo "Please specify a command\n";
    return;
}

(new Kernel())->command(implode(" ", from($argv)
    ->where('$c ==> $c != "radical.php"')
    ->toArray())
);