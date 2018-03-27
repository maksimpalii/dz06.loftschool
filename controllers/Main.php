<?php

namespace App;

class Main extends MainController
{
    public function index()
    {
        $sitekey = '6Lfe4E4UAAAAAF9umcbQw6G6LCVJ2zDg2NXnfK_u';
        $this->view->twigLoad('main', ['sitekey' => $sitekey, 'url' => 'submit']);
    }
}