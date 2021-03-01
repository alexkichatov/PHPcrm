<!DOCTYPE html>
<html lang="ru" data-ng-app="order">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $pageData['title']; ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="/css/admin/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/css/admin/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="/css/admin/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Кабинет</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="/admin/profile"><i class="fa fa-user fa-fw"></i> Профиль</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="/admin/logout"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="/admin"><i class="fa fa-area-chart"></i> Заказы</a>
                            </li>
                            <li>
                                <a href="/admin/products"><i class="fa fa-cart-plus"></i> Склад</a>
                            </li>
                            <li>
                                <a href="/admin/users"><i class="fa fa-user-o"></i> Клиенты</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper" data-ng-controller="orderController">
                <?php if (isset($_GET['orderId']) && $_GET['orderId'] != '' && !empty($pageData['orderInfo'])) { ?>


                    <div class="row">
                        <div class="col-md-12">
                            <h2><?php echo $pageData['title']; ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Состав заказа</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Товар</th>
                                    <!--<th>Цена, руб.</th>-->
                                    <th>Количество</th>
                                    <!--<th>Стоимость, руб.</th>-->
                                </tr>
                                <?php
                                foreach ($pageData['orderInfo'] as $val) { ?>
                                    <tr>
                                        <td>
                                            <select id="productID" name="productID" class="form-control">
                                                <?php foreach ($pageData['all Products'] as $product) { ?>
                                                    <option <?php if($product['id']==$val['product_id']) {echo "selected";} ?> value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
        <?php } ?>       
                                            </select>
                                        </td>
                                       <!-- <td><?php echo $val['price']; ?><input type="text" value="<?php echo $val['price']; ?>" data-ng-model="productPrice" id="productPrice" class="form-control"></td>-->
                                        <td><input type="text" value="<?php echo $val['quantity']; ?>" data-ng-model="<?php echo $val['quantity']; ?>" id="productQuantity" class="form-control"></td>
                                        <!-- <td><?php echo $sum; ?></td>-->
                                    </tr>
    <?php } ?>
                                <tr>
                                   <!-- <td><strong>Итого:</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong><?php echo $ksum; ?></strong></td>-->
                                </tr>
                            </table>

                            <h3>Покупатель:</h3>
                            <select name="clientID" class="form-control">
                                <?php foreach ($pageData['getUsers'] as $users) { ?>
                                    <option <?php if($users['id']==$val['product_id']) {echo "selected";} ?> value="<?php echo $users['id']; ?>"><?php echo $users['fullName']; ?></option>
    <?php } ?>       
                            </select>
                            <h3>Статус</h3>
                            <div class="form-group">
                                <?php foreach ($pageData['orderStatus'] as $status) {  ?>
<input id="orderStatus"  name="orderStatus" type="radio" <?=$status['value'] === $val['status'] ? 'checked' : ''?> value='<?=$status['value']?>'>
<label><?php echo $status['label']; ?></label>
    <?php } ?>       
                            </div>
                            <div class="form-group">
                            <button class="btn btn-success" data-ng-click="editOrder(<?php echo $_GET['orderId']; ?>)">Сохранить</button>
                            </div>
                        </div>
                    </div>
<?php } else { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Заказ не найден</h2>
                        </div>
                    </div>
<?php } ?>    
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="/js/jquery.js"></script>

        <!-- Angular -->
        <script src="/js/angular.min.js"></script>
        <script src="/js/admin/order.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="/js/admin/metisMenu.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="/js/admin/sb-admin-2.js"></script>

    </body>

</html>
