<?php
include_once("../core.php");
if(!$islogin){
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
if (isset($_GET['mod'])) {
    $mod = $_GET['mod'];
} else {
    $mod = 'info';
}
define('IN_PLUGIN', '星益云www.96xy.cn');
if ($mod == 'info') {
    $active['info'] = null;
} elseif ($mod == "achievement") {
    $active['achievement'] = null;
} elseif ($mod == "info_submit") {
    $wzbt = addslashes($_POST['wzbt']);
    $wzgjz = addslashes($_POST['wzgjz']);
    $wzms = addslashes($_POST['wzms']);
    $bqxx = addslashes($_POST['bqxx']);
    $contact_time = addslashes($_POST['contact_time']);
    $boy_qq = addslashes($_POST['boy_qq']);
    $girl_qq = addslashes($_POST['girl_qq']);
    $pass = addslashes($_POST['pass']);

    if ($pass == "") {
        $pass = $core['pass'];
    } else {
        $pass = md5($pass);
    }
    $sql = "update `xingyi_love_core` set `wzbt` ='{$wzbt}',`wzgjz` ='{$wzgjz}',`wzms` ='{$wzms}',`bqxx` ='{$bqxx}',`contact_time` ='{$contact_time}',`boy_qq` ='{$boy_qq}',`girl_qq` ='{$girl_qq}',`pass` ='{$pass}' where `id`='1'";
    if (mysqli_query($db_link, $sql)) {   //判断是否成功
        exit("<script language='javascript'>alert('修改成功');window.location.href='./info.php';</script>");
    } else {
        exit("<script language='javascript'>alert('修改失败');window.location.href='javascript:history.go(-1)';</script>");
    }
} elseif ($mod == "achievement_submit") {
    $arr = [];
    for ($i = 0; $i < 8; $i++) {
        $arr[] = array(
            'title' => addslashes($_POST['achievement' . $i . '_title']),
            'light_up_date'=>addslashes($_POST['achievement' . $i . '_time']),
            'light_up'=>($_POST['achievement' . $i . '_time']=='')?false:true
        );
    }
    $json = addslashes(json_encode($arr));
    $sql = "update `xingyi_love_core` set `achievement` ='{$json}' where `id`='1'";
    if (mysqli_query($db_link, $sql)) {   //判断是否成功
        exit("<script language='javascript'>alert('修改成功');window.location.href='./info.php?mod=achievement';</script>");
    } else {
        exit("<script language='javascript'>alert('修改失败');window.location.href='javascript:history.go(-1)';</script>");
    }
}
include_once("./head.php");
?>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <ul class="nav nav-pills">
        <li class="<?php echo ($mod == 'info') ? 'active' : ''; ?>"><a href="info.php">基本信息</a></li>
        <li class="<?php echo ($mod == 'achievement') ? 'active' : ''; ?>"><a href="info.php?mod=achievement">恋爱成就</a>
        </li>
    </ul>
    <hr/>
    <div class="panel panel-primary">
        <?php
        if ($mod == 'info'){
        ?>
        <div class="panel-heading"><h3 class="panel-title">基本信息</h3></div>
        <div class="panel-body">
            <form action="info.php?mod=info_submit" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">网站标题</label>
                    <div class="col-sm-10"><input type="text" name="wzbt" value="<?php echo $core['wzbt']; ?>"
                                                  class="form-control" required=""></div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">网站关键字</label>
                    <div class="col-sm-10"><input type="text" name="wzgjz" value="<?php echo $core['wzgjz']; ?>"
                                                  class="form-control" required=""></div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">网站描述</label>
                    <div class="col-sm-10"><input type="text" name="wzms" value="<?php echo $core['wzms']; ?>"
                                                  class="form-control"></div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">底部版权</label>
                    <div class="col-sm-10"><textarea type="text" name="bqxx" class="form-control"
                                                     rows="3"><?php echo $core['bqxx']; ?></textarea></div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">交往时间</label>
                    <div class="col-sm-10"><input type="text" name="contact_time"
                                                  value="<?php echo $core['contact_time']; ?>" class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">男孩QQ</label>
                    <div class="col-sm-10"><input type="text" name="boy_qq" value="<?php echo $core['boy_qq']; ?>"
                                                  class="form-control"></div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">女孩QQ</label>
                    <div class="col-sm-10"><input type="text" name="girl_qq" value="<?php echo $core['girl_qq']; ?>"
                                                  class="form-control"></div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-sm-2 control-label">后台密码</label>
                    <div class="col-sm-10"><input type="text" name="pass" class="form-control" placeholder="不修改则留空">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改"
                                                                  class="btn btn-primary form-control"><br>
                    </div>
                </div>
            </form>
            <?php
            } elseif ($mod == "achievement") {
                ?>
                <div class="panel-heading"><h3 class="panel-title">恋爱成就</h3></div>
                <div class="panel-body">
                    <form action="info.php?mod=achievement_submit" method="post" class="form-horizontal" role="form">
                        <font color="green">最多设置8个成就，不点亮的成就时间留空即可，成就名称最好不要超过10个字</font>
                        <?php
                        for ($i = 0; $i < 8; $i++) {
                            ?>
                            <div><h4 style="text-align: center;">成就<?php echo $i + 1; ?></h4></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">成就名称</label>
                                <div class="col-sm-10"><input type="text" name="achievement<?php echo $i; ?>_title"
                                                              value="<?php echo $achievement[$i]['title']; ?>"
                                                              class="form-control"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">点亮时间</label>
                                <div class="col-sm-10"><input type="text" name="achievement<?php echo $i; ?>_time"
                                                              value="<?php echo $achievement[$i]['light_up_date']; ?>"
                                                              class="form-control" placeholder="不点亮则留空"></div>
                            </div><br>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改"
                                                                          class="btn btn-primary form-control"><br>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
</div>
</body>
</html>