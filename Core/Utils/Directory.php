<?php

namespace Core\Utils;

class Directory
{

    private string $directory;

    function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function getAllFiles()
    {
        return array_values(from(scandir($this->directory))
            ->where('$file ==> $file != "." && $file != ".."')
            ->toArray());
    }

}