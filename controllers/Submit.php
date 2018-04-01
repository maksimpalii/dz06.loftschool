<?php

namespace App;

class Submit extends MainController
{
    public function index()
    {
        $name = $this->clearAll($_REQUEST['name']);
        $phone = $this->clearAll($_REQUEST['phone']);
        $email = $this->clearAll($_REQUEST['email']);

        $contacts = 'Имя: ' . $name . '<br>' . "\n" . 'Телефон:' . $phone . '<br>' . "\n" . 'Email: ' . $email . '<br><br>' . "\n";

        $street = $this->clearAll($_REQUEST['street']);
        $home = $this->clearAll($_REQUEST['home']);
        $part = $this->clearAll($_REQUEST['part']);
        $appt = $this->clearAll($_REQUEST['appt']);
        $floor = $this->clearAll($_REQUEST['floor']);
        $adress = $street . ', ' . $home . ', Корпус: ' . $part . ', Квартира: ' . $appt . ', Этаж:' . $floor;
        $comment = $this->clearAll($_REQUEST['comment']);

        $payment = $this->clearAll($_REQUEST['payment']);
        $callback = $this->clearAll($_REQUEST['callback']);

        $detOrd_1 = '';
        $detOrd_2 = '';

        if ($payment === 'on') {
            $detOrd_1 = 'Потребуется сдача.';
        }
        if ($callback === 'on') {
            $detOrd_2 = 'Не перезванивать';
        }
        $detail_order = $detOrd_1 . ' ' . $detOrd_2;

        $content = '<h3>DarkBeefBurger за 500 рублей, 1 шт</h3>' . '<br>' . "\n";
        $content .= '<p>Ваш заказ будет доставлен по адресу - ' . $adress . '</p>';

        function getTime()
        {
            $time = microtime(true);
            $dFormat = 'Y-m-d_H-i-s';
            $mSecs = $time - floor($time);
            $mSecs = substr($mSecs, 2, 4);
            $newtime = date($dFormat) . '-' . $mSecs;
            return $newtime;
        }

        function msgThanks()
        {
            $count = func_get_arg(0);
            if ($count === 1) {
                return '<br><br>' . '---' . '<br>' . 'Спасибо - это ваш первый заказ!';
            } else {
                return '<br><br>' . '---' . '<br>' . 'Спасибо! Это уже ' . $count . ' заказ!';
            }
        }

        function logMsg($contentMsg)
        {
            if (is_dir('maillog') === true) {
                file_put_contents('maillog/' . getTime() . '.txt', $contentMsg);
            } else {
                mkdir('maillog');
                file_put_contents('maillog/' . getTime() . '.txt', $contentMsg);
            }
        }

        if (!empty($name) && !empty($phone) && !empty($email) && !empty($street) && !empty($home) && !empty($part) && !empty($appt) && !empty($floor)) {

            $remoteIp = $_SERVER['REMOTE_ADDR'];
            $gRecaptchaResponse = $_REQUEST['g-recaptcha-response'];
            $recaptcha = new \ReCaptcha\ReCaptcha(SESCRET);
            $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
            if ($resp->isSuccess()) {
                $verifiUser = new User();
                $data = $verifiUser->verificationUser($email);
                if ($data['email'] === $email) {
                    echo 'message';
                } else {
                    $registrUser = new User();
                    $registrUser->registrUser($name, $phone, $email);
                    $verifiUser = new User();
                    $data = $verifiUser->verificationUser($email);
                    echo 'message & registration';
                }
                $user_id = $data['id'];
                $order = new Order();
                $order->addOrder($user_id, $adress, $comment, $detail_order);
                $lastOrderId = $order->lastOrderId();
                $ordersId = new Order();
                $ordersId->getOrderById($user_id);
                $orderCount = $ordersId->getOrderById($user_id);
                $subject = 'Заказ № ' . $lastOrderId;
                $content .= "\n" . 'Детали заказа: ' . "\n" . $detail_order . "\n";
                $content .= msgThanks($orderCount);
                $contentMsg = '<h2>' . $subject . '</h2>' . "\n" . $contacts . $content;
                logMsg($contentMsg);
                $ema = new Mail();
                $test = $ema->sendMail($email, $subject, $contentMsg);
            } else {
                echo 'captcha no';
            }

        } elseif (!empty($name) && !empty($phone) && !empty($email)) {
            $verifiUser = new User();
            $data = $verifiUser->verificationUser($email);
            if ($data['email'] === $email) {
                echo 'autorisation';
            } else {
                $registrUser = new User();
                $registrUser->registrUser($name, $phone, $email);
                echo 'registration';
            }
        } else {
            echo 'not empty';
        }

        die();
    }
}

