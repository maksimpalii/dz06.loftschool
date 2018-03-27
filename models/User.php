<?php
namespace App;

class User extends MainController
{

    public function getAllUser()
    {
        $usersView = $this->getPD()->prepare('SELECT * FROM users');
        $usersView->execute();
        $data = $usersView->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }
    public function getAllOrder()
    {
        $usersView = $this->getPD()->prepare('SELECT * FROM orders');
        $usersView->execute();
        $data = $usersView->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

}
