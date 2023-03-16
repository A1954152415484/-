<?php
include_once("../core.php");
if($islogin){
    exit("<script language='javascript'>alert('您已登录！');window.location.href='./index.php';</script>");
}
if (isset($_POST['submit']) && isset($_POST['admin']) && isset($_POST['pass'])) {
    if ($_POST['admin'] == "" or $_POST['pass'] == "") {
        exit("<script language='javascript'>alert('账号或密码不能为空！');window.location.href='./login.php';</script>");
    }
    if ($core['admin'] != $_POST['admin'] or $core['pass'] != md5($_POST['pass'])) {
        exit("<script language='javascript'>alert('账号或密码错误！');window.location.href='./login.php';</script>");
    } else {
        //登录成功
        $_SESSION['xingyi_love_login'] = hash('ripemd160', $core['admin'] . $core['pass'] . SALT);  //账号密码加盐 - 哈希加密
        exit("<script language='javascript'>window.location.href='./index.php';</script>");
    }
}elseif(isset($_GET['logout'])){
    if(isset($_SESSION['xingyi_love_login'])) {
        unset($_SESSION['xingyi_love_login']);
    }
    exit("<script language='javascript'>alert('退出成功！');window.location.href='./login.php';</script>");
} else {
    ?>
    <html>
    <head>
        <title>后台登录</title>
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
                <a class="navbar-brand" href="./">后台登录</a>
            </div><!-- /.navbar-header -->
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="./login.php"><span class="glyphicon glyphicon-user"></span> 登陆</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- /.navbar -->
    <div class="container" style="padding-top:70px;">
        <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">后台登录</h3></div>
                <div class="panel-body">
                    <form action="./login.php" method="post" class="form-horizontal" role="form">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="admin" value="" class="form-control input-lg" placeholder="账号"
                                   required="required">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="pass" class="form-control input-lg" placeholder="密码"
                                   required="required">
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-xs-12"><input type="submit" value="立即登陆"
                                                          class="btn btn-primary form-control input-lg" name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>