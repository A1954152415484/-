<?php
include_once("../core.php");
if(!$islogin){
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
define('IN_PLUGIN', '星益云www.96xy.cn');
$active['index']=null;
include_once("./head.php");
?>
<div class="col-xs-12 col-sm-10 col-lg-10 center-block" style="float: none;">
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">后台首页</h3></div>
        <div class="panel-body">

            <div class="jumbotron">
                <h1>我们的小窝</h1>
                <p>欢迎回来</p>
                <p><a class="btn btn-primary btn-lg" href="http://www.96xy.cn/" role="button">星益云</a> <a class="btn btn-primary btn-lg" href="./info.php" role="button">基本信息</a></p>
            </div>

        </div>
    </div>
</div>
</div>
</body>
</html>