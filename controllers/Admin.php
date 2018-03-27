<?php

namespace App;

class Admin extends MainController
{
    public function index()
    {
        $userModel = new User();
        $data['users'] = $userModel->getAllUser();
        $data['orders'] = $userModel->getAllOrder();
        $this->view->twigLoad('admin', $data);
    }
}