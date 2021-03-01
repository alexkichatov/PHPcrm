<?php

class OrdersModel extends Model {

    public function getOrderInfoByOrderId($orderId) {
        $result = array();
        $sql = "SELECT users.fullName, users.address, users.phone,users.id as user_id, users.email, orders.amount, orders.status,productsInOrders.quantity, productsInOrders.product_id, productsInOrders.id as productsInOrders_id, products.name, products.price FROM users
        INNER JOIN orders ON orders.user_id = users.id
        INNER JOIN productsInOrders ON orders.id = productsInOrders.order_id
        INNER JOIN products ON productsInOrders.product_id = products.id
        WHERE orders.id = :orderId";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":orderId", $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function saveOrderInfo($id, $user_id, $status) {
        $sql = "UPDATE orders
                SET user_id = :user_id, status = :status
                WHERE id = :id
                ";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":status", $status, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
        public function addOrderInfo($user_id, $status) {
        $sql = "INSERT INTO orders(user_id, status)
                VALUES(:user_id, :status)
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":status", $status, PDO::PARAM_STR);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $last_id = $this->db->lastInsertId();
        return $last_id;
    }
            public function addOrderProducts($order_id, $product_id, $quantity) {
        $sql = "INSERT INTO productsInOrders(order_id, product_id, quantity)
                VALUES(:order_id, :product_id, :quantity)
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":order_id", $order_id, PDO::PARAM_INT);
        $stmt->bindValue(":product_id", $product_id, PDO::PARAM_INT);
        $stmt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    
    public function saveOrderProducts($id, $order_id, $product_id, $quantity) {
        $sql = "UPDATE 	productsInOrders
                SET order_id = :order_id, product_id = :product_id, quantity = :quantity
                WHERE id = :id
                ";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":order_id", $order_id, PDO::PARAM_INT);
        $stmt->bindValue(":product_id", $product_id, PDO::PARAM_INT);
        $stmt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }

    public function deleteOrder($orderId) {
        $sql = "DELETE FROM productsInOrders WHERE order_id = :orderId;
                DELETE FROM orders WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":orderId", $orderId, PDO::PARAM_INT);
        $stmt->bindValue(":id", $orderId, PDO::PARAM_INT);
        $stmt->execute();      
    }

    public function getAllProducts() {
        $result = array();
            $sql = "SELECT * FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }
        public function getUsersRoles() {
        $result = array();
        $sql = "SELECT * FROM role";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }
    public function getUsers() {
        $sql = "SELECT * FROM users WHERE role_id = 3";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }


}