<!DOCTYPE html>
<html lang="ru" data-ng-app="admin">
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
                <a class="navbar-brand" href="/">Кабинет</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/admin/profile">
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
                            <a href="/admin"><span class="order-img menu-img"></span> Заказы</a>
                        </li>
                        <li>
                            <a href="/admin/products"><span class="product-img menu-img"></span> Склад</a>
                        </li>
                        <li>
                            <a href="/admin/users"><span class="client-img menu-img"></span> Клиенты</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" data-ng-controller="adminController">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Заказы</h1>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel"><button class="btn btn-danger btn-lg" data-ng-click="newOrder()">Создать заказ</button>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="order-img"></div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                            echo $pageData['ordersCount'];
                                        ?>
                                    </div>
                                    <div>заказов</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                <div class="col-xs-3">
                                    <div class="product-img"></div>
                                </div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                            echo $pageData['productsCount'];
                                        ?>
                                    </div>
                                    <div>товаров</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="client-img"></div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                            echo $pageData['usersCount'];
                                        ?>
                                    </div>
                                    <div>клиентов</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <form name="searchOrderForm"  data-ng-submit="searchOrder()"  id="searchform">
                                <div class="input-group">
                                    <div class="form-outline" style="float: left;">
                                        <input type="search" name="search" value="<?php echo $_GET['search'];?>" id="search"  class="form-control" />
                                        <label class="form-label" for="form1">Поиск по номеру заказа</label>
                                    </div>
                                    <button class="btn btn-danger">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Номер заказа</th>
                                                    <th>ФИО клиента</th>
                                                    <th>Наименование</th>
                                                    <th>Кол-во, шт.</th>
                                                    <th>Сумма, руб.</th>
                                                    <th>Адрес</th>
                                                    <th>Телефон</th>
                                                    <th>Статус</th>
                                                    <th></th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($pageData['orders'] as $key=>$value) {
                                                echo "<tr>";
                                                    echo "<td>" . $value['id']. "</td>";
                                                  //  echo "<td>" . $value['total'] . "</td>";
                                                    echo "<td>" . $value['fullName'] . "</td>";
                                                    echo "<td>" . $value['name'] . "</td>";
                                                    echo "<td>" . $value['quantity'] . "</td>";
                                                    echo "<td>" . $value['price']*$value['quantity'] . "</td>";
                                                    echo "<td>" . $value['address'] . "</td>";
                                                    echo "<td>" . $value['phone'] . "</td>";
                                                    echo "<td>" . $value['status'] . "</td>";
                                                    echo "<td><button class='btn btn-sm btn-default' data-ng-click='openOrderDetails(". $value['id'].")'>Просмотр</button><button class='btn btn-sm btn-default' data-ng-click='editOrder(". $value['id'].")'>Изменить</button><button class='btn btn-sm btn-danger' data-ng-click='deleteOrder(". $value['id'].")'>Удалить</button></td>";
                                                    
                                                echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Angular -->
    <script src="/js/angular.min.js"></script>
    <script src="/js/admin/admin.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/admin/metisMenu.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/admin/sb-admin-2.js"></script>

</body>

</html>
