<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="utf-8">
    <base href="/admin/products/">
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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Профиль</a>
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

        <div id="page-wrapper" data-ng-app="products" data-ng-controller="productsController">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $pageData['title']; ?></h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="col-lg-12" data-ng-view></div>
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <form name="searchProductForm"  data-ng-submit="searchProduct()"  id="searchform">
                                <div class="input-group">
                                    <div class="form-outline" style="float: left;">
                                        <input type="search" name="search" value="<?php echo $_GET['search'];?>" id="search"  class="form-control" />
                                        <label class="form-label" for="form1">Поиск</label>
                                    </div>
                                    <button class="btn btn-danger">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    
                                </div>
                            </form>
                        </div>


                        <!-- /.panel-heading -->
                        <div class="panel-body" >
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Наименование товара</th>
                                                    <th>Цена, руб.</th>
                                                    <th>Складской остаток, шт.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($pageData['productsOnPage'] as $key => $value) { ?>
                                                        <tr>
                                                            <td><?php echo $value['id']; ?></td>
                                                            <td><a data-ng-click="getInfoByProductId(<?php echo $value['id']; ?>)" href="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
                                                            <td><?php echo $value['price']; ?></td>
                                                            <td><?php echo $value['quantity']; ?></td>
                                                            <td>
                                                                <a data-ng-click="getInfoByProductId(<?php echo $value['id']; ?>)" href="<?php echo $value['id']; ?>"><button class="btn btn-sm btn-default">Изменить</button></a>
                                                                <button class="btn btn-sm btn-danger" data-ng-click="deleteOrder(<?php echo $value['id']; ?>)">Удалить</button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <?php echo $pageData['pagination']; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-7">
                    <h2>Добавить товар</h2>
                    <form class="form-horizontal" name="addProductForm" data-ng-submit="addProduct()">
                        <legend>Добавить товар</legend>
                        <div class="form-group">
                            <label for="newProductName" class="col-sm-3">Наименование товара</label>
                            <div class="col-sm-9">
                                <input type="text" name="newProductName" data-ng-model="newProductName" id="newProductName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newProductPrice" class="col-sm-3">Цена товара, руб.</label>
                            <div class="col-sm-9">
                                <input type="text" name="newProductPrice" data-ng-model="newProductPrice" id="newProductPrice" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newProductQuantity" class="col-sm-3">Складской остаток, шт.</label>
                            <div class="col-sm-9">
                                <input type="text" name="newProductQuantity" data-ng-model="newProductQuantity" id="newProductQuantity" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-danger">Добавить</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!--<div class="col-lg-12">
                    <h2>Загрузить CSV файл с товарами</h2>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <label for="exampleInputFile">Загрузите CSV файл</label>
                        <input type="file" name="csv">
                        <button class="btn btn-default">Загрузить</button>
                    </form>
                </div>-->
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

    <!-- Angular Route -->
    <script src="/js/angular-route.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/admin/metisMenu.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/admin/sb-admin-2.js"></script>

    <script src="/js/admin/products.js"></script>

</body>

</html>
