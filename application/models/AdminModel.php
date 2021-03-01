<?php

class AdminModel extends Model {

    public function getOrdersCount() {
        $sql = "SELECT COUNT(*) FROM orders";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function getProductsCount() {
        $sql = "SELECT COUNT(*) FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function getUsersCount() {
        $sql = "SELECT COUNT(*) FROM users WHERE role_id=3";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function getOrders() {
        if (!isset($_GET['search'])) {
                    $sql = "SELECT
                    orders.id,
                    orders.amount as total,
                    orders.status,
                    productsInOrders.quantity,
                    products.name,
                    products.price,
                    users.fullName,
                    users.address,
                    users.phone,
                    users.email
                FROM orders
                INNER JOIN users ON users.id = orders.user_id
                INNER JOIN productsInOrders ON productsInOrders.order_id = orders.id
                INNER JOIN products ON products.id = productsInOrders.product_id
                GROUP BY orders.id
                        ";
        } else {
           $search = $_GET['search'];
                   $sql = "SELECT
                    orders.id,
                    orders.amount as total,
                    orders.status,
                    productsInOrders.quantity,
                    products.name,
                    products.price,
                    users.fullName,
                    users.address,
                    users.phone,
                    users.email
                FROM orders
                INNER JOIN users ON users.id = orders.user_id
                INNER JOIN productsInOrders ON productsInOrders.order_id = orders.id
                INNER JOIN products ON products.id = productsInOrders.product_id
                WHERE orders.id LIKE '%$search%'
                GROUP BY orders.id
                        ";
        }
        $result = array();
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }
}

 ?>
