<?php

namespace App;

use claviska\SimpleImage;

class Image extends MainController
{
    public function index()
    {
        $protocol = $_SERVER['REQUEST_SCHEME'] . '://';
        $server = $_SERVER['SERVER_NAME'];
        $url = $protocol . $server;
        $newImg = $url . '/img/public/new-image.png';
        $image = new SimpleImage();
        $image
            ->fromFile(__DIR__ . '/../img/public/foo.jpg')
            ->rotate('45', 'transparent')
            ->overlay(__DIR__ . '/../img/public/watermark.png', 'center center')
            ->fitToWidth(200)
            ->toFile(__DIR__ . '/../img/public/new-image.png', 'image/png');
        $this->view->twigLoad('image', ['image' => $newImg]);
    }
}