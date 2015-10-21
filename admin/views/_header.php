<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 17:29
 */
global $G;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>まるトク会員サービス管理画面</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-black.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        table th:nth-child(3),
        table th:nth-child(4),
        table th:nth-child(5),
        table td:nth-child(3),
        table td:nth-child(4) { text-align: center; }
    </style>
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="dist/img/logo.png" class="img-responsive"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>NEWS</b> 更新ツール</span> </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="<?php echo $G['action']=='index' ? 'active' : '' ?>">
                    <a href="index.php"><i class="fa fa-link"></i> <span>ダッシュボード</span> <i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li class="<?php echo in_array($G['action']['post']) ? 'active' : '' ?>">
                    <a href="index.php?a=post"><i class="fa fa-edit"></i> <span>投稿</span> <i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li class="<?php echo in_array($G['action'],['user']) ? 'active' : '' ?>">
                    <a href="index.php?a=user"><i class="fa fa-user"></i> <span>ユーザー</span> <i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="index.php?a=logout"><i class="fa fa-sign-out"></i> <span>ログアウト</span> <i class="fa fa-angle-right pull-right"></i></a>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
