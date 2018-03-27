<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Form extends MainController
{

    public function DataPrepare()
    {
        $clearData = new User();
        $newData = $clearData->clearAll($_REQUEST, true);

        $name = $newData['name'];
        $phone = $newData['phone'];
        $email = $newData['email'];

        $contacts = 'Имя: ' . $name . "<br>" . 'Телефон: ' . $phone . "<br>" . 'Email: ' . $email . "<br>";

        $street = $newData['street'];
        $home = $newData['home'];
        $part = $newData['part'];
        $appt = $newData['appt'];
        $floor = $newData['floor'];
        $adress = 'Улица ' . $street . ', Дом: ' . $home . ', Корпус: ' . $part . ', Квартира: ' . $appt . ', Этаж:' . $floor;
        $comment = $newData['comment'];

        $payment = $newData['payment'];
        $callback = $newData['callback'];

        $detOrd_1 = '';
        $detOrd_2 = '';

        if ($payment === 'on') {
            $detOrd_1 = 'Потребуется сдача.';
        }
        if ($callback === 'on') {
            $detOrd_2 = 'Не перезванивать';
        }
        $detail_order = $detOrd_1 . ' ' . $detOrd_2;

        $content = '<h3>DarkBeefBurger за 500 рублей, 1 шт</h3>' . "\n";
        $content .= '<p>Ваш заказ будет доставлен по адресу - ' . $adress . '</p>' . "\n";
        return ['name' => $name, 'phone' => $phone, 'email' => $email, 'contacts' => $contacts, 'adress' => $adress, 'comment' => $comment, 'detail_order' => $detail_order, 'content' => $content];
    }

}
