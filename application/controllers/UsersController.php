<?php

class UsersController extends Controller{

    private $pageTpl = "/application/views/users.tpl.php";

    public function __construct() {
        $this->model = new UsersModel();
        $this->view = new View();
        $this->utils = new Utils();
    }

    public function index() {

    //    header("Location: /");
    //        exit();
            
        if(!$_SESSION['user']) {
            header("Location: /");
            exit();
        }
      
      

        $this->pageData['permission'] = $_SESSION['role_id'];

        $this->pageData['title'] = "Клиенты";
        $this->pageData['usersList'] = $this->model->getUsers();
        $this->pageData['clientList'] = $this->model->getClients();
        $this->view->render($this->pageTpl, $this->pageData);

    }

    public function getUserById() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(isset($_POST['id']) && $_POST['id'] != '') {
            $userId = $_POST['id'];
            $userInfo = json_encode($this->model->getUserById($userId));
            echo $userInfo;

        } else {
            echo json_encode(array("success" => false, "text" => "Ошибка"));
        }
    }

    public function getUsersRoles() {
        
        if(!$_SESSION['user']) {
            header("Location: /");
        }

        $roles = $this->model->getUsersRoles();
        if(empty($roles)) {
            echo json_encode(array("success" => false, "text" => "Ошибка"));
        } else {
            echo json_encode($roles);
        }

    }  

    public function updateUserData() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(!empty($_POST) && !empty($_POST['id']) && !empty($_POST['fullName']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['address'])) {
            $userId = $_POST['id'];
            $userFullName = strip_tags(trim($_POST['fullName']));
            $userAddress = strip_tags(trim($_POST['address']));
            $userEmail = strip_tags(trim($_POST['email']));
            $userPhone = $_POST['phone'];
            $this->model->updateUserInfo($userId, $userFullName, $userAddress, $userEmail, $userPhone);
            echo json_encode(array("success" => true, "text" => "Данные пользователя сохранены"));    
        } else {
            echo json_encode(array("success" => false, "text" => "Заполните все данные"));
        }

    }

    public function deleteUser() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(!empty($_POST) && !empty($_POST['id'])) {
            $userId = $_POST['id'];
            $this->model->deleteUser($userId);
            echo json_encode(array("success" => true, "text" => "Пользователь успешно удален"));
        } else {
            echo json_encode(array("success" => false, "text" => "Произошла ошибка. Попробуйте позже"));
        }
    }

    public function addNewUser() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        if(!empty($_POST) && !empty($_POST['fullName']) && !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['email'])) {
            $newUser = strip_tags(trim($_POST['fullName']));
            $newLogin = trim(strip_tags($_POST['email']));
            $newAddress = trim(strip_tags($_POST['address']));
            $newPhone = trim(strip_tags($_POST['phone']));
            $newEmail = strip_tags(trim($_POST['email']));
            $newPassword = strip_tags(trim(md5($_POST['password'])));
            $passwordForEmail = strip_tags(trim($_POST['password']));
            $newRole = '3';
            $this->model->addNewUser($newLogin, $newUser, $newEmail, $newPassword, $newRole, $newAddress, $newPhone);
            echo json_encode(array("success" => true, "text" => "Новый пользователь добавлен"));  
        } else {
            echo json_encode(array("success" => false, "text" => "Заполните все данные"));
        }

    }

}
