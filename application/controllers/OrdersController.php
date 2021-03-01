<?php

class OrdersController extends Controller {

    private $pageTpl = "/application/views/order.tpl.php";

    public function __construct() {
        $this->model = new OrdersModel();
        $this->view = new View();
    }

    public function index() {
        if (!$_SESSION['user']) {
            header("Location: /");
            exit();
        }

        $this->pageData['title'] = "Детали заказа";
        if (isset($_GET['orderId'])) {
            $orderId = intval($_GET['orderId']);
            if ($orderId > 0) {
                $this->pageData['orderInfo'] = $this->model->getOrderInfoByOrderId($orderId);
            }
        }
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function edit() {
        if (!$_SESSION['user']) {
            header("Location: /");
            exit();
        }

        $this->pageData['title'] = "Изменение заказа";
        if (isset($_GET['orderId'])) {
            $orderId = intval($_GET['orderId']);
            if ($orderId > 0) {
                $this->pageData['orderInfo'] = $this->model->getOrderInfoByOrderId($orderId);
                $this->pageData['all Products'] = $this->model->getAllProducts();
                $this->pageData['getUsers'] = $this->model->getUsers();
                $this->pageData['orderStatus'] = [
                    ['label' => 'в обработке', 'value' => 'в обработке'],
                    ['label' => 'оплачен', 'value' => 'оплачен'],
                    ['label' => 'доставляется', 'value' => 'доставляется'],
                    ['label' => 'отменен', 'value' => 'отменен'],
                ];

                //    print_r($this->pageData['orderInfo']);
            }
        }
        $this->pageTpl = "/application/views/edit-order.tpl.php";
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function checkOrder() {
        if (isset($_POST['id'])) {
            $orderId = $_POST['id'];
            $orderInfo = $this->model->getOrderInfoByOrderId($orderId);
            $fullName = $orderInfo[0]['fullName'];
            $email = $orderInfo[0]['email'];
            $amount = $orderInfo[0]['amount'];
            $productsArr = array();
            $productsPricesArr = array();
            foreach ($orderInfo as $item) {
                array_unshift($productsArr, $item['name']);
                array_unshift($productsPricesArr, $item['price']);
            }
            $this->sendCheckOrderMail($fullName, $email, $amount, $productsArr, $productsPricesArr);
            echo json_encode(array("success" => true, "text" => "Заказ одобрен"));
        } else {
            echo json_encode(array("success" => true, "text" => "Ошибка"));
        }
    }

    public function deleteOrder() {
        if (isset($_POST['id'])) {
            $orderId = $_POST['id'];
            $this->model->deleteOrder($orderId);
            echo json_encode(array("success" => true, "text" => "Заказ удален"));
        } else {
            echo json_encode(array("success" => true, "text" => "Не удалось удалить заказ"));
        }
    }

}

?>
