<?php

namespace App;

class MainModel
{

    protected function getPD()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8';
        $pdo = new \PDO($dsn, DB_USERNAME, DB_PASSWORD);
        return $pdo;
    }
}