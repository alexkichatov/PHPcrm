<?php

class AdminController extends Controller {

    private $pageTpl = "/application/views/admin.tpl.php";

    public function __construct() {
        $this->model = new AdminModel();
        $this->view = new View();
    }

    public function index() {

       if(!$_SESSION['user']) {
           header("Location: /");
           exit();
        }

        $this->pageData['title'] = "Кабинет";

        $ordersCount = $this->model->getOrdersCount();
        $this->pageData['ordersCount'] = $ordersCount;

        $productsCount = $this->model->getProductsCount();
        $this->pageData['productsCount'] = $productsCount;

        $usersCount = $this->model->getUsersCount();
        $this->pageData['usersCount'] = $usersCount;

        $orders = $this->model->getOrders();
        $this->pageData['orders'] = $orders;

        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function logout() {
        session_destroy();
        header("Location: /");
    }

    

}

 ?>
