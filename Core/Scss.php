<?php

namespace Core;

use \App\Config;
use \ScssPhp\ScssPhp\Compiler;
use \Core\Utils\Directory;
use \MatthiasMullie\Minify;

class Scss
{

    private const SCSS_RESOURCES = ROOT."/resources/scss/";

    private array $files;

    function __construct()
    {
        $this->files = (new Directory(self::SCSS_RESOURCES))->getAllFiles();
    }

    public function compile()
    {
        $compiler = new Compiler();
        $compiled = "";

        foreach($this->files as $file)
        {
            $compiled .= $compiler->compile(file_get_contents(self::SCSS_RESOURCES.$file));
        }

        header("Content-type: text/css; charset: UTF-8");

        echo Config::DEVELOPMENT ? $compiled : (new Minify\CSS())->add($compiled)->minify();
    }

}