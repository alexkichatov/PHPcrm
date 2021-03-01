<?php

class ProductsModel extends Model {

    public function getAllProducts() {
        $result = array();
        echo $_GET['search'];
        if (!isset($_GET['search'])) {
            $sql = "SELECT * FROM products";
        } else {
           $search = $_GET['search'];
           echo $_GET['search'];
           $sql = "SELECT * FROM products WHERE name LIKE '%$search%'"; 
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }

    public function getLimitProducts($leftLimit, $rightLimit) {
        $result = array();
                if (!isset($_GET['search'])) {
            $sql = "SELECT * FROM products LIMIT :leftLimit, :rightLimit";
        } else {
           $search = $_GET['search'];
           $sql = "SELECT * FROM products  WHERE name LIKE '%$search%' LIMIT :leftLimit, :rightLimit"; 
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":leftLimit", $leftLimit, PDO::PARAM_INT);
        $stmt->bindValue(":rightLimit", $rightLimit, PDO::PARAM_INT);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }

        return $result;
    }

    public function addFromCSV($data) {
        $sql = "INSERT INTO products(name, price) VALUES(:name, :price)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":name", $data[0], PDO::PARAM_STR);
        $stmt->bindValue(":price", $data[1], PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getProductById($id) {
        $result = array();
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function saveProductInfo($id, $name, $price, $quantity) {
        $sql = "UPDATE products
                SET price = :price, name = :name, quantity = :quantity
                WHERE id = :id
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }


    public function addProduct($productName, $productPrice, $productQuantity) {
        $sql = "INSERT INTO products(name, price, quantity)
                VALUES(:productName, :productPrice, :productQuantity)
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":productName", $productName, PDO::PARAM_STR);
        $stmt->bindValue(":productPrice", $productPrice, PDO::PARAM_INT);
        $stmt->bindValue(":productQuantity", $productQuantity, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0) {
            return true;
        } else {
            return false;
        }

    }

}

 ?>
