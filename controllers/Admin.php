<?php

namespace App;

class Admin extends MainController
{
    public function index()
    {
        echo MAIL_USERNAME;

        $userModel = new User();
        $data['users'] = $userModel->getAllUser();
        $data['orders'] = $userModel->getAllOrder();
        $this->view->twigLoad('admin', $data);
    }
}