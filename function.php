<?php
function micro() {
    $array = file('./micro.txt');
    $count = rand(0,count($array)-1);
    $word = iconv('gb2312', 'UTF-8',$array[$count]);

    return $word;
}
function fetch($q){
	return mysqli_fetch_assoc($q);
}
function only(){
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i = 6; $i > 0; $i--) {
        $string .= $char[mt_rand(0, strlen($char) - 1)];
    }
    return md5($string.uniqid(microtime(true),true));
}
function ip()
{
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}
function photoList($json,$path = "./img/photo/"){
    if(!$name_arr = json_decode($json,true)){
        $name_arr=[];
    }
    $mb_str = opendir($path);  //模板文件夹路径
    while (($filename = readdir($mb_str)) !== false) {
        if ($filename != "." && $filename != "..") {
            $mb_array[] = array(
                'title'=> (array_key_exists($filename,$name_arr))?$name_arr[$filename]:"未知标题",
                'name'=>$filename,
                'height'=>getimagesize($path.$filename)[1],
                'path'=>$path.$filename
            );
        }
    }
    closedir($mb_str);
    $mb_array = array_filter($mb_array);  //删除数组内的空值

    $left_height = 0;$right_height = 0;
    $left_arr = [];$right_arr = [];
    for ($i=0;$i<count($mb_array);$i++){
        if($left_height<=$right_height){
            $left_arr[] = $mb_array[$i];
            $left_height+=$mb_array[$i]['height'];
        }else{
            $right_arr[] = $mb_array[$i];
            $right_height+=$mb_array[$i]['height'];
        }
    }
    return array('left'=>$left_arr,"right"=>$right_arr,'list'=>$mb_array);
}