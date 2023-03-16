<?php
include_once("../core.php");
if(!$islogin){
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
if (isset($_GET['mod'])) {
    if($_GET['mod']=="submit"){
        $arr = [];
        if(is_uploaded_file($_FILES['file']['tmp_name'])) {
            $temp = explode('.',  $_FILES['file']['name']);
            $imgtype = end($temp);//取数组的最后一个
            $filetype = ['jpg', 'jpge', 'gif', 'png'];//定义图片类型
            if (!in_array($imgtype, $filetype)) {
                exit("<script language='javascript'>alert('抱歉，不支持该格式！');window.location.href='./img.php';</script>");
            } else {
                $Random=date("YmdHis")."_".md5(uniqid(microtime(true),true));
                $name=$Random.'.'.$imgtype;
                if(!move_upload_file($_FILES['file']['tmp_name'],'../img/photo/',$name)){
                    exit("<script language='javascript'>alert('新图片上传失败！');window.location.href='./img.php';</script>");
                }else{
                    $arr[$name] = "";
                }
            }
        }
        $list = photoList($core['img'],"../img/photo/");
        foreach ($list['list'] as $v){
            $arr[$v['name']] = addslashes($_POST['img_'.str_replace('.','_',$v['name'])]);
        }
        $json = addslashes(json_encode($arr));
        $sql = "update `xingyi_love_core` set `img` ='{$json}' where `id`='1'";
        if (mysqli_query($db_link, $sql)) {   //判断是否成功
            exit("<script language='javascript'>alert('修改成功');window.location.href='./img.php';</script>");
        } else {
            exit("<script language='javascript'>alert('修改失败');window.location.href='javascript:history.go(-1)';</script>");
        }
    }elseif($_GET['mod']=='del'){
        if(!isset($_GET['name'])){
            exit("<script language='javascript'>alert('请选择要删除的图片');window.location.href='./img.php';</script>");
        }
        $list = photoList($core['img'],"../img/photo/");
        $arr = [];
        foreach ($list['list'] as $v){
            if($v['name'] == $_GET['name']){
                unlink($v['path']);
            }else{
                $arr[$v['name']] = $v['title'];
            }
        }
        $json = addslashes(json_encode($arr));
        $sql = "update `xingyi_love_core` set `img` ='{$json}' where `id`='1'";
        if (mysqli_query($db_link, $sql)) {   //判断是否成功
            exit("<script language='javascript'>alert('删除成功');window.location.href='./img.php';</script>");
        } else {
            exit("<script language='javascript'>alert('删除失败');window.location.href='javascript:history.go(-1)';</script>");
        }
    }
}
define('IN_PLUGIN', '星益云www.96xy.cn');
$active['img'] = null;
include_once("./head.php");
?>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">点滴记录</h3></div>
        <div class="panel-body">
            <form action="?mod=submit" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">上传新图片&nbsp;-可以不选择</label>
                    <div class="col-sm-10"><input type="file" name="file" class="form-control"/></div>
                </div>
                <font color="green">如果无法上传，则可能是服务器权限、扩展等原因导致。你可以手动将图片上传到：根目录/img/photo/ 文件夹里</font>
            <div class="row">

                <?php
                $list = photoList($core['img'],"../img/photo/");
                foreach ($list['list'] as $v){
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="<?php echo $v['path']; ?>" alt="...">
                        <div class="caption">
                            <input type="text" name="img_<?php echo str_replace('.','_',$v['name']); ?>" value="<?php echo $v['title']; ?>" class="form-control" required="设置图片标题">
                            <hr/>
                            <p><a href="?mod=del&name=<?php echo $v['name']; ?>" class="btn btn-danger btn-block">删除</a></p>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>

            </div>
            <input type="submit" name="submit" value="保存修改" class="btn btn-primary form-control">
            </form>
        </div>
        </div>
    </div>
</div>
</div>
</body>
</html>