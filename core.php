<?php
/*
 * 数据库配置
 */
$dbconfig = array(
    'host' => 'localhost', //数据库服务器
    'port' => 3306, //数据库端口
    'user' => 'root', //数据库用户名
    'pwd' => 'root', //数据库密码
    'name' => 'love' //数据库名
);
//======================================================


error_reporting(0);//关闭报错
session_start();
define('SALT', '6438200b4d006584e3c7ca2ce5c3bca6');  //盐
date_default_timezone_set("PRC");//设置时区
@header('Content-Type: text/html; charset=UTF-8');
include_once("function.php");//扩展功能
$db_link = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['name'], $dbconfig['port']);
if (!$db_link) {
    $db_link = true;
    exit(
        '<p><b>数据库连接失败</b></p>' .
        '<p>错误信息：Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() . '</p>'
    );
}
if (mysqli_query($db_link, "select * from `xingyi_love_core` where 1") == FALSE) {
    exit(
    "<b>抱歉，请先导入数据库！</b><br/>SQL文件在根目录/love.sql"
    );
}

$core = fetch(mysqli_query($db_link, "SELECT * FROM `xingyi_love_core` WHERE id=1 limit 1"));//获取网站系统配置
$interval = date_diff(date_create($core['contact_time']), date_create(date("Y-m-d")));  //相恋时间
$blessing_count= fetch(mysqli_query($db_link, "SELECT count(*) as `count` FROM `xingyi_love_blessing`"))['count'];//统计祝福次数

if ($achievement = json_decode($core['achievement'], true)) {
    if (count($achievement) < 8) {
        exit("恋爱成就只能是8个！");
    }
} else {
    exit("恋爱成就json解析失败！");
}
$islogin = false;
if (isset($_SESSION['xingyi_love_login'])) {
    $hash = hash('ripemd160', $core['admin'] . $core['pass'] . SALT);  //账号密码加盐 - 哈希加密
    if ($hash == $_SESSION['xingyi_love_login']) {
        $islogin = true;
    }
}