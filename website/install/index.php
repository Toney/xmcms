<?php
date_default_timezone_set('prc');
error_reporting(E_ALL ^ E_NOTICE);
if(file_exists("../config/install.lock"))
{
    header("location:/");
}
session_start();
$_SESSION['install']='xminfo';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>小麦企业网站管理系统安装</title>
    <link href="css/960.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="js/validate/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
    <link href="js/loadmask/jquery.loadmask.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/loadmask/jquery.loadmask.min.js"></script>
    <script type="text/javascript" src="js/validate/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="js/validate/jquery.validationEngine-zh_CN.js"></script>
</head>
<body>

    <div class="container_12 mgt">
        <div class="grid_12 bg_white plr cont_text ">
            <div class="lh30" style="height:40px;line-height:40px;"><label>小麦CMS安装步骤：</label>
                1.阅读使用协议>
                2.系统环境检测>
                3.数据库设置>
                4.管理员设置>
                5.安装完成
            </div>
        </div>
    </div>

    <div class="container_12 mgt">

        <div class="grid_12 bg_white plr cont_text ">
            <div class="mgt_10 lh30 mgb_10"><label><h2>1.小麦CMS使用协议</h2></label></div>
            <p>
                小麦CMS是在GNU通用公共许可协议下发布开源免费的信息管理系统，你享有的权利，使用制约如下：
            </p>
            <p>
                <label>自由</label><br>
                GPL授予程序接受人以下权利，或称“自由”：<br>
                以任何目的运行此程序的自由；<br>
                再发行复制件的自由；
            </p>
            <p>
                <label>授予的权利</label><br>
                GPL的条款和条件适用于任何收到GPL下的作品的人（即“许可证接受人”）。任何接受这些条款和条件的许可证接受人都有修改、复制、再发行作品 或作品的演绎版本的授权。
            </p>
            <p>
                <label>Copyleft</label><br>
                GPL不会授予许可证接受人无限的权利。再发行权的授予需要许可证接受人开放软件的源代码，及所有修改。且复制件、修改版本，都必须以GPL为许可证。
            </p>
        </div>
    </div>

    <?php
    $yes_icon = "<img src='img/yes.png'/>";
    $no_icon = "<img src='img/no.png'/>";
    ?>
    <div class="container_12 mgt">
        <div class="grid_12 bg_white plr cont_text ">
            <div class="mgt_10 lh30 mgb_10"><label><h2>2.系统环境检测</h2></label></div>
            <table class="list cont_text mgb_10">
                <tr>
                    <td class="w19p"><label>MySQL支持：</label></td>
                    <td class="w31p">
                        <?php
                        $mysql_support = (function_exists( 'mysql_connect')) ? ON : OFF;
                        if(function_exists( 'mysql_connect')){
                           echo $yes_icon;
                        }else {
                           echo $no_icon;
                        }
                        ?>
                    </td>
                    <td class="w19p"><label>PHP版本（>=5.1.0）：</label></td>
                    <td class="w31p">
                        <?php
                        if(PHP_VERSION<'5.1.0'){
                            echo $no_icon;
                        }else {
                            echo $yes_icon;
                        }
                        ?>
                    </td>
                </tr>
            </table>

            <table class="list cont_text mgb_10">
                    <tr>
                        <td colspan="2">
                            <label>相关函数</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="w19p">file_put_contents函数：</td>
                        <td>
                            <?php
                            if(!function_exists('file_put_contents')){
                               echo "<span class='red'>空间不支持file_put_contents函数，系统无法写文件。</span>";
                            }else{
                                echo $yes_icon;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w19p">
                            fsockopen函数,<br>pfsockopen函数,<br>stream_socket_client函数：
                        </td>
                        <td>
                            <?php
                            if(!function_exists('fsockopen')&&!function_exists('pfsockopen')&&!function_exists('stream_socket_client')){
                                echo "<span class='red'>空间不支持fsockopen，pfsockopen,stream_socket_client函数，系统邮件功能不能使用。请至少开启其中一个。</span>";
                            }else{
                                echo $yes_icon;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w19p">copy函数：</td>
                        <td>
                            <?php
                            if(!function_exists('copy')){
                                echo "<span class='red'>空间不支持copy函数，无法上传文件。</span>";
                            }else{
                                echo $yes_icon;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>imagecreate函数：</td>
                        <td>
                            <?php
                            if(!function_exists('imagecreate')){
                                echo "<span class='red'>空间不支持imagecreate函数，无法生成验证码。</span>";
                            }else{
                                echo $yes_icon;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w19p">ini_set函数：</td>
                        <td>
                            <?php
                            if(!function_exists('ini_set')){
                               echo "<span class='red'>空间不支持ini_set函数，系统无法正常包含文件，导致后台会出现空白现象。</span>";
                            }else{
                                echo $yes_icon;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w19p">session支持：</td>
                        <td>
                            <?php
                            if($_SESSION['install']!='xminfo'){
                                echo "<span class='red'>空间不支持session，无法登陆后台。</span>";
                            }else{
                                echo $yes_icon;
                            }
                            ?>
                        </td>
                    </tr>
            </table>

            <table class="list cont_text mgb_10">
                <tr>
                    <td colspan="2">
                        <label>文件目录权限</label>
                    </td>
                </tr>

                <?php
                function is_writable_xm($dir){
                    $str='';
                    $is_dir=0;
                    $info='xmcms';
                    if(is_dir($dir)){
                        $dir=$dir.'xmcms.txt';
                        $is_dir=1;
                        $info='xmcms';
                    }
                    else{
                        $fp = @fopen($dir,'r+');
                        $i=0;
                        while($i<10){
                            $info.=@fgets($fp);
                            $i++;
                        }
                        @fclose($fp);
                        if($info=='')return false;
                    }
                    $fp = @fopen($dir,'w+');
                    @fputs($fp, $info);
                    @fclose($fp);
                    if(!file_exists($dir))return false;
                    $fp = @fopen($dir,'r+');
                    $i=0;
                    while($i<10){
                        $str.=@fgets($fp);
                        $i++;
                    }
                    @fclose($fp);
                    if($str!=$info)return false;
                    if($is_dir==1){
                        @unlink($dir);
                    }
                    return true;
                }

                $w_check=array(
                    '../',
                    '../config/',
                    '../assets/',
                    '../config/db.php',
                    '../config/config.php',
                    '../attached/file/',
                    '../attached/flash/',
                    '../attached/image/',
                    '../protected/runtime/',
                    '../protected/runtime/cache/',
                    '../install/db/',
                );
                $class_chcek=array();
                $check_msg = array();
                $count=count($w_check);
                for($i=0; $i<$count; $i++){
                    if(!file_exists($w_check[$i])){
                        $check_msg[$i].= '<span class="red">文件或文件夹不存在请上传</span>';$check=0;
                    } elseif(is_writable_xm($w_check[$i])){
                        $check_msg[$i].= '通 过';
                        $check=1;
                    } else{
                        $check_msg[$i].='<span class="red">777属性检测不通过</span>'; $check=0;
                    }
                    if($check!=1 and $disabled!='disabled'){$disabled = 'disabled';}
                }

                for($i=0;$i<$count;$i++){
                    ?>
                    <tr>
                        <td class="w19p"><?php echo $w_check[$i]; ?></td>
                        <td><?php echo $check_msg[$i]; ?></td>
                    </tr>
                    <?php
                }
                ?>

            </table>

        </div>
    </div>

    <form id="form_validate" name="form_validate">
    <div class="container_12 mgt">
        <div class="grid_12 bg_white plr cont_text ">
            <div class="mgt_10 lh30 mgb_10"><label><h2>3.数据库设置</h2></label></div>
            <table class="list cont_text mgb_10">
                <tr>
                    <td class="w19p">数据库主机<span class="red">*</span></td>
                    <td><input name="ip" class="ui validate[required]" type="text" /></td>
                </tr>
                <tr>
                    <td class="w19p">端口<span class="red">*</span></td>
                    <td><input name="port" class="ui validate[required,custom[integer]]" type="text" value="3306" /></td>
                </tr>
                <tr>
                    <td class="w19p">数据库名<span class="red">*</span></td>
                    <td><input name="dbname" class="ui validate[required]" type="text" /></td>
                </tr>
                <tr>
                    <td class="w19p">数据库用户名<span class="red">*</span></td>
                    <td><input name="username" class="ui validate[required]" type="text" /></td>
                </tr>
                <tr>
                    <td class="w19p">数据库密码<span class="red">*</span></td>
                    <td><input name="password" class="ui validate[required]" type="text" /></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="container_12 mgt">
        <div class="grid_12 bg_white plr cont_text ">
            <div class="mgt_10 lh30 mgb_10"><label><h2>4.管理员设置</h2></label></div>
            <table class="list cont_text mgb_10">
                <tr>
                    <td class="w19p">管理员账号<span class="red">*</span></td>
                    <td>administrator</td>
                </tr>
                <tr>
                    <td class="w19p">密码<span class="red">*</span></td>
                    <td><input id="password" name="password" class="ui validate[required]" type="password" /></td>
                </tr>
                <tr>
                    <td class="w19p">确认密码<span class="red">*</span></td>
                    <td><input id="confirm_password" name="confirm_password" class="ui validate[required,equals[password]] " type="password" /></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="container_12 mgt mgb">
        <div class="grid_12 bg_white plr cont_text ">
            <div class="mgt_10 lh30 mgb_10"><label><h2>5.完成安装</h2></label></div>
            <div class="mgt_10 lh30 mgb_10"><input type="button" class="ui" value="进行安装" onclick="form_submit()" /></div>
        </div>
    </div>

    </form>

    <script type="text/javascript">
        //$(function(){$('input').attr('data-prompt-position','centerRight');});
        function form_submit(){
            if($('#form_validate').validationEngine('validate')){
                //数据库测试
                var param = {
                    ip:$("#form_validate").find("input[name=ip]").val(),
                    port:$("#form_validate").find("input[name=port]").val(),
                    dbname:$("#form_validate").find("input[name=dbname]").val(),
                    username:$("#form_validate").find("input[name=username]").val(),
                    password:$("#form_validate").find("input[name=password]").val()
                };

                $("#form_validate").mask("正在验证数据配置是否正确！");
                $.get('test.php',param,function(res){
                    if(res == 1){
                        $("#form_validate").mask("正在导入数据库！");
                        //导入数据，设置超级管理员账号密码
                        $.get('import.php',null,function(res){
                            if(res ==1){
                                $("#form_validate").mask("正在设置数据库密码！");
                                $.get('savepwd.php',{password:$("input[name=password]").val()},function(res){
                                    if(res == 1){
                                        window.location.href="success.php";
                                    }
                                });

                            }else{
                                alert(res);
                            }
                            $("#form_validate").unmask();
                        });
                    }else{
                        $("#form_validate").unmask();
                        alert('数据库未能连接成功！');
                    }
                });
            }
        }
    </script>





</body>
</html>