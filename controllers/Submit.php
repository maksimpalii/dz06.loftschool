<?php

namespace App;

use PDO;
use PHPMailer\PHPMailer\PHPMailer;


class Submit extends MainController
{
    public function index()
    {
        $registr = $this->getPD()->prepare('INSERT INTO users (name, number, email) VALUES (:name, :number, :email)');
        $verification = $this->getPD()->prepare('SELECT * FROM users where email =:email');
        $order = $this->getPD()->prepare('INSERT INTO orders (user_id, adress_order, detail_order, comment_order) VALUES (:user_id, :adress_order, :detail_order, :comment_order)');
        $orderselect = $this->getPD()->prepare('SELECT * FROM orders where user_id =:user_id');

        $dataPrep = new Form();
        $prepData = $dataPrep->DataPrepare();

        //var_dump($prepData);


        function getTime()
        {
            $time = microtime(true);
            $dFormat = 'Y-m-d_H-i-s';
            $mSecs = $time - floor($time);
            $mSecs = substr($mSecs, 2, 4);

            $newtime = date($dFormat) . '-' . $mSecs;
            return $newtime;
        }

        function msgThanks($orderCount)
        {
            $count = func_get_arg(0);
            if ($count === 1) {
                return "\n \n" . '---' . "\n" . 'Спасибо - это ваш первый заказ!';
            } else {
                return "\n \n" . '---' . "\n" . 'Спасибо! Это уже ' . $count . ' заказ!';
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
            die();
        }

        if (!empty($_REQUEST['name']) && !empty($_REQUEST['phone']) && !empty($_REQUEST['email']) && !empty($_REQUEST['street']) && !empty($_REQUEST['home']) && !empty($_REQUEST['part']) && !empty($_REQUEST['appt']) && !empty($_REQUEST['floor'])) {

            //$remoteIp = $_SERVER['REMOTE_ADDR'];
            // $gRecaptchaResponse = $_REQUEST['g-recaptcha-response'];
            // $recaptcha = new \ReCaptcha\ReCaptcha('6Lfe4E4UAAAAAByyOx1avgmpkP9SWbhSBltDDuVD');
            //$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
//            if ($resp->isSuccess()) {
            $verification->execute(['email' => $prepData['email']]);
            $data = $verification->fetch(PDO::FETCH_ASSOC);
            if ($data['email'] === $prepData['email']) {

                echo 'message';
            } else {
                $registr->execute(['name' => $prepData['name'], 'number' => $prepData['phone'], 'email' => $prepData['email']]);
                $verification->execute(['email' => $prepData['email']]);
                $data = $verification->fetch(PDO::FETCH_ASSOC);
                echo 'message & registration';
            }
            $user_id = $data['id'];
            $order->execute(['user_id' => $user_id, 'adress_order' => $prepData['adress'], 'comment_order' => $prepData['comment'], 'detail_order' => $prepData['detail_order']]);
            $lastOrderId = $this->getPD()->lastInsertId();
            $orderselect->execute(['user_id' => $user_id]);
            $ordersId = $orderselect->fetchAll(PDO::FETCH_ASSOC);
            $orderCount = count($ordersId);
            $subject = 'Заказ № ' . $lastOrderId;
            $content = $prepData['content'] . "\n" . 'Детали заказа: ' . "\n" . $prepData['detail_order'] . "\n";
            $content .= msgThanks($orderCount);
            $contentMsg = '<h2>' . $subject . '</h2>' . "\n" . $prepData['contacts'] . $content;


            $ema = new Mail();
            $test = $ema->sendMail($prepData['email'], $subject, $contentMsg);
            echo $test;
            logMsg($contentMsg);
//            } else {
//                echo 'captcha no';
//            }

        } elseif (!empty($_REQUEST['name']) && !empty($_REQUEST['phone']) && !empty($_REQUEST['email'])) {
            $verification->execute(['email' => $prepData['email']]);
            $data = $verification->fetch(PDO::FETCH_ASSOC);
            if ($data['email'] === $prepData['email']) {
                echo 'autorisation';
            } else {
                $registr->execute(['name' => $prepData['name'], 'number' => $prepData['phone'], 'email' => $prepData['email']]);
                echo 'registration';
            }
        } else {
            echo 'not empty';
        }

        die();
    }
}