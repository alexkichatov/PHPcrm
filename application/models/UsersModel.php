<?php

class UsersModel extends Model {

    public function getUsers() {
        $sql = "SELECT users.id, users.login, users.fullName, users.email, role.name as role FROM users
                INNER JOIN role ON users.role_id = role.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }
        public function getClients() {
                    if (!isset($_GET['search'])) {
            $sql = "SELECT * FROM users WHERE role_id = 3";
        } else {
           $search = $_GET['search'];
           $sql = "SELECT * FROM users WHERE role_id = 3 and fullName LIKE '%$search%'";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }

    public function getUserById($userId) {
        $sql = "SELECT users.id, users.address, users.phone, users.email, users.fullName, users.login, role.name as role FROM users
                INNER JOIN role ON users.role_id = role.id
                WHERE users.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)) {
            return $result;
        } else {
            return false;
        }
        
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

    public function updateUserInfo($userId, $userFullName, $userAddress, $userEmail, $userPhone) {
        $sql = "UPDATE users
                SET address = :address, fullName = :fullName, email = :email, phone = :phone
                WHERE id = :id    
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":address", $userAddress, PDO::PARAM_STR);
        $stmt->bindValue(":fullName", $userFullName, PDO::PARAM_STR);
        $stmt->bindValue(":email", $userEmail, PDO::PARAM_STR);
        $stmt->bindValue(":phone", $userPhone, PDO::PARAM_STR);
        $stmt->bindValue(":id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return true;        
    }

    public function addNewUser($userLogin, $userFullName, $userEmail, $userPassword, $userRole, $userAddress, $userPhone) {
        $sql = "INSERT INTO users(login, fullName, email, password, role_id, address, phone)
                VALUES (:login, :fullName, :email, :password, :role_id, :address, :phone)   
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $userLogin, PDO::PARAM_STR);
        $stmt->bindValue(":fullName", $userFullName, PDO::PARAM_STR);
        $stmt->bindValue(":email", $userEmail, PDO::PARAM_STR);
        $stmt->bindValue(":password", $userPassword, PDO::PARAM_STR);
        $stmt->bindValue(":address", $userAddress, PDO::PARAM_STR);
        $stmt->bindValue(":phone", $userPhone, PDO::PARAM_STR);
        $stmt->bindValue(":role_id", $userRole, PDO::PARAM_INT);
        $stmt->execute();
        return true;        
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }


}
