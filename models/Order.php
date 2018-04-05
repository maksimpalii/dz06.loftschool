<?php

namespace App;

class Order extends MainModel
{
    public function getAllOrder()
    {
        $usersView = $this->getPD()->prepare('SELECT * FROM orders');
        $usersView->execute();
        $data = $usersView->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function addOrder($user_id, $adress, $comment, $detail_order)
    {
        $order = $this->getPD()->prepare('INSERT INTO orders (user_id, adress_order, detail_order, comment_order) VALUES (:user_id, :adress_order, :detail_order, :comment_order)');
        $order->execute(['user_id' => $user_id, 'adress_order' => $adress, 'comment_order' => $comment, 'detail_order' => $detail_order]);
    }

    public function getOrderById($user_id)
    {
        $orderselect = $this->getPD()->prepare('SELECT * FROM orders where user_id =:user_id');
        $orderselect->execute(['user_id' => $user_id]);
        $ordersId = $orderselect->fetchAll(\PDO::FETCH_ASSOC);
        return count($ordersId);
    }

    public function lastOrderId()
    {
        $q = $this->getPD()->prepare('SELECT * FROM orders ORDER BY id_order DESC LIMIT 1');
        $q->execute();
        $data = $q->fetch(\PDO::FETCH_ASSOC);
        return $data['id_order'];
    }

}
