<?php

namespace Core;

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

        echo $twig->render($template, $args);
    }
}
