<?php

namespace App;

class MainController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function getPD()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8';
        $pdo = new \PDO($dsn, DB_USERNAME, DB_PASSWORD);
        return $pdo;
    }

    public function clearAll($datas, $isarray = false)
    {
        if ($isarray === false) {
            $data1 = strip_tags($datas);
            $data = htmlspecialchars($data1, ENT_QUOTES);
        } else {
            $data = [];
            foreach ($datas as $key => $value) {
                $data[$key] = htmlspecialchars(strip_tags($value), ENT_QUOTES);
            }
        }
        return $data;
    }

}