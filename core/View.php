<?php

namespace App;

use Twig_Environment;

class View
{
    public function render($filename, array $data)
    {
        extract($data);
        require_once __DIR__ . "/../views/" . $filename . ".php";
    }

    public function __construct($data = [])
    {
        $this->loader = new \Twig_Loader_Filesystem('views');
        $this->twig = new Twig_Environment($this->loader);
    }

    public function twigLoad($filename, array $data)
    {
        echo $this->twig->render($filename . '.twig', $data);
    }
}
