<?php
if(!defined('IN_PLUGIN'))exit();
?>
<html>
<head>
    <title>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="//cdn.staticfile.org/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">导航按钮</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">后台管理</a>
        </div><!-- /.navbar-header -->
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?php echo (array_key_exists('index',$active))?"active":""; ?>">
                    <a href="./index.php"><span class="glyphicon glyphicon-home"></span> 后台首页</a>
                </li>
                <li class="<?php echo (array_key_exists('info',$active))?"active":""; ?>">
                    <a href="./info.php"><span class="glyphicon glyphicon-cog"></span> 基本信息</a>
                </li>
                <li class="<?php echo (array_key_exists('achievement',$active))?"active":""; ?>">
                    <a href="./info.php?mod=achievement"><span class="glyphicon glyphicon-list-alt"></span> 恋爱成就</a>
                </li>
                <li class="<?php echo (array_key_exists('img',$active))?"active":""; ?>">
                    <a href="./img.php"><span class="glyphicon glyphicon-picture"></span> 点滴记录</a>
                </li>
                <li class="<?php echo (array_key_exists('logout',$active))?"active":""; ?>">
                    <a href="./login.php?logout"><span class="glyphicon glyphicon-log-out"></span> 退出</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->
<div class="container" style="padding-top:70px;">
