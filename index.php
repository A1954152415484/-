<?php
include_once("core.php");
$ip = ip();
$date = date('Y-m-d H:i:s');
$temp_blessing = fetch(mysqli_query($db_link, "SELECT count(*) as `count` FROM `xingyi_love_blessing` WHERE `ip`='{$ip}' and `time`>= date(now())"))['count'];
$isblessing = ($temp_blessing>0)?true:false;
if (isset($_POST['blessing'])) {
    if(strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])===false){
        exit(json_encode(['code' => 1, "msg" => "非法请求源"]));
    }
    if($isblessing){
        exit(json_encode(['code' => 1, "msg" => "抱歉，你今天已经祝福过一次了哦，明天再来吧！"]));
    }
    $sql = "INSERT INTO `xingyi_love_blessing` (`ip`, `time`) VALUES ('{$ip}', '{$date}')";
    if(mysqli_query($db_link, $sql)){
        exit(json_encode(['code' => 0, "msg" => "成功"]));
    }else{
        exit(json_encode(['code' => 1, "msg" => "祝福失败，请稍后重试！"]));
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $core['wzbt']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="./css/style.css">

    <style type="text/css">
        body {
            background: url("img/bj.png") no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
<!-- 全局 -->
<div class="container" style="margin-top:30px">
    <!-- 主体布局 -->
    <div class="col-lg-12 center-block" style="float: none;">

        <div class="XY-box">
            <img src="img/head.png"/>
            <div class="XY-xlrq">我们已经相恋 <?php echo $interval->format('%a') + 1; ?> 天了</div>
            <div class="XY-body">
                <div class="XY-head-tx">
                    <!-- 男头像 -->
                    <div class="portrait"><img
                                src="http://q.qlogo.cn/headimg_dl?dst_uin=<?php echo $core['boy_qq']; ?>&spec=640&img_type=jpg"/>
                    </div>
                    <!-- 心 -->
                    <div class="love"><img src="<?php echo ($isblessing)?'img/love2.png':'img/love1.png'; ?>" id="love" class="<?php echo ($isblessing)?'':'enlarge'; ?>"/></div>
                    <!-- 女头像 -->
                    <div class="portrait"><img
                                src="http://q.qlogo.cn/headimg_dl?dst_uin=<?php echo $core['girl_qq']; ?>&spec=640&img_type=jpg"/>
                    </div>
                    <div class="XY-record">共收到了 <span id="record_num"><?php echo $blessing_count; ?></span> 份祝福</div>
                </div>
            </div>
        </div>


        <div class="XY-box">
            <div class="XY-title XY-color-blue">点滴记录</div>

            <div class="XY-micro XY-color-pink"><?php echo micro(); ?></div>
            <div class="XY-card-body">
                <!-- 左 -->
                <div class="XY-card-left">
                    <?php
                    $list = photoList($core['img']);
                    foreach ($list['left'] as $v) {
                        ?>
                        <div class="XY-card">
                            <img src="<?php echo $v['path']; ?>" class="big-img"
                                 onclick="preview('<?php echo $v['path']; ?>','<?php echo $v['title']; ?>')"/>
                            <div class="txt">
                                <?php echo $v['title']; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- 右 -->
                <div class="XY-card-right">
                    <?php
                    foreach ($list['right'] as $v) {
                        ?>
                        <div class="XY-card">
                            <img src="<?php echo $v['path']; ?>" class="big-img"
                                 onclick="preview('<?php echo $v['path']; ?>','<?php echo $v['title']; ?>')"/>
                            <div class="txt">
                                <?php echo $v['title']; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div style="padding: 8px"></div>
        </div>

        <div class="XY-box">
            <div class="XY-title XY-color-blue">海誓山盟</div>
            <div class="XY-body" style="text-align: center;">
                <p class="XY-everyday-title">·&nbsp;&nbsp;恋爱成就</p>
                <div></div>
                <?php
                for ($i = 1; $i <= 8; $i++) {

                    ?>
                    <!-- 成就 -->
                    <div class="XY-everyday-accum" style="background: url('img/accum/<?php echo $i; ?>.gif')">
                        <div class="left">
                            <div class="img"><img src="img/icon/<?php echo $i; ?>.svg"/></div>
                        </div>
                        <div class="right">
                            <div class="title"><?php echo $achievement[$i - 1]['title']; ?></div>
                            <div class="txt"><?php echo micro(); ?></div>
                            <div class="tab"><?php echo ($achievement[$i - 1]['light_up_date'] == '') ? '待点亮' : $achievement[$i - 1]['light_up_date']; ?></div>
                            <div>
                                <button class="XY-button enlarge XY-color-<?php echo ($achievement[$i - 1]['light_up']) ? "yellow" : "pink"; ?>"
                                        style="bottom: 10px;position: relative;color:#000;font-size: 14px;"><?php echo ($achievement[$i - 1]['light_up']) ? "已点亮" : "待点亮"; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- 成就 -->
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="XY-box">
            <div class="XY-title XY-color-blue">关于我们</div>
            <div class="XY-body">
                <?php echo $core['bqxx']; ?>
            </div>
        </div>


    </div>
</div>
<!-- JS -->
<link href="./js/layer/theme/default/layer.css" rel="stylesheet">
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/layer/layer.js"></script>
<script type="text/javascript">
    var love = <?php echo ($isblessing)?0:1; ?>;
    function preview(path, title) {
        var json = {
            "title": "图片预览",
            "id": 1,
            "start": 0,
            "data": [{"alt": title, "pid": 1, "src": path, "thumb": path}]
        };
        layer.photos({
            photos: json
            , anim: 0
        });
    }

    <?php
    if(!$isblessing){
        echo "layer.tips('点我送祝福', '#love', {tips: [1, '#ff576e']});";
    }
    ?>
    $("#love").click(function () {
        if(love!=1){
            layer.msg('今天已经祝福过了，明天再来吧！');
            return;
        }
        var Load = layer.load(0, {shade: [0.3, '#000']}); //开始加载
        $.ajax({
            type: "POST",
            url: "./",
            data: {"blessing": ""},
            dataType: "json",
            success: function (data) { //SUCCESS
                if (data.code == 0) {
                    layer.close(Load); //关闭加载
                        layer.open({
                            type: 1
                            ,
                            title: false //不显示标题栏
                            ,
                            closeBtn: true
                            ,
                            area: '250px;background:none;border-radius: 20px;'
                            ,
                            shade: 0.5
                            ,
                            resize: false
                            ,
                            anim: 1					//0-6的动画形式，-1不开启
                            ,
                            moveType: 1 //拖拽模式，0或者1
                            ,
                            scrollbar: true //滚动条
                            ,
                            content: '<div style="padding: 14px 24px; line-height: 22px;background:#ff576e; color: #fff;border-radius: 20px;height:200px">'
                                + '<div style="text-align:center;"><img src="img/love2.png" style="width: 4rem;height: 4rem;"/></div>'
                                + '<div class="XY-advanced" style="background: url(\'img/accum/6.gif\')">'
                                + '<div class="date">么么哒</div>'
                                + '<div>感谢您的 <span style="color: #fc6c6c;font-weight: 600;">祝福</span></div>'
                                + '</div>'
                                + '</div>'
                        });
                        $("#love").attr('src', 'img/love2.png');
                        $("#love").removeClass('enlarge');
                        var num = parseInt($("#record_num").html());
                        $("#record_num").html(num+1);
                        love = 0;
                } else {
                    layer.close(Load); //关闭加载
                    var indexa = layer.alert(data.msg, {title: data.title, icon: 5}, function () {
                        layer.close(indexa);
                    })
                }
            },
            error: function () { //ERROR
                layer.close(Load); //关闭加载
                layer.msg('系统繁忙');
                return false;
            }
        });
    });
</script>
</body>
</html>