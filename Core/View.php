<?php

namespace Core;

use App\Config;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    // Used for rendering a template using TWIG.
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new Environment($loader);
        }

        $twig->addGlobal("SCSS", "/resources/".(Config::DEVELOPMENT ? random_int(1, 99999) : 0)."/Scss/");

        echo $twig->render($template, $args);
    }
}
