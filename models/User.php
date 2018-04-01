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

    public function registrUser($name, $phone, $email)
    {
        $registr = $this->getPD()->prepare('INSERT INTO users (name, number, email) VALUES (:name, :number, :email)');
        $registr->execute(['name' => $name, 'number' => $phone, 'email' => $email]);
    }

    public function verificationUser($email)
    {
        $verification = $this->getPD()->prepare('SELECT * FROM users where email =:email');
        $verification->execute(['email' => $email]);
        $data = $verification->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }
}
