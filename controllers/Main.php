<?php

namespace App;

class Main extends MainController
{
    public function index()
    {
        $this->view->twigLoad('main', ['sitekey' => SITEKEY, 'url' => 'submit']);
    }
}
