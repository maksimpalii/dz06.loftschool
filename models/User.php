<?php
namespace App;

class User extends MainController
{
    protected function getPD()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8';
        $pdo = new \PDO($dsn, DB_USERNAME, DB_PASSWORD);
        return $pdo;
    }
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
