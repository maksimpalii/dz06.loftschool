<?php

namespace App;

class Admin extends MainController
{
    public function index()
    {
        $userModel = new User();
        $orderModel = new Order();
        $data['users'] = $userModel->getAllUser();
        $data['orders'] = $orderModel->getAllOrder();
        $this->view->twigLoad('admin', $data);
    }
}