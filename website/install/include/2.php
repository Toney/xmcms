<div class="contenttext round" style="padding:30px;">
    <h1 class="title">检查您的服务器是否支持安装XmInfo企业网站管理系统，请在继续安装前消除错误或警告信息。</h1>
    <fieldset>
        <legend>环境监测结果</legend>
        <ul class="list">
            <?php
            $errormsg = Array();
            $check = 0;
            $mysql_support = (function_exists( 'mysql_connect')) ? ON : OFF;
            if(function_exists( 'mysql_connect')){
                $mysql_support  = 'ON';
                $mysql_ver_class ='OK';
            }else {
                $mysql_support  = 'OFF';
                $mysql_ver_class ='WARN';
            }
            if(PHP_VERSION<'5.0.0'){
                $ver_class = 'WARN';
                $errormsg['version']='php 版本过低';
            }else {
                $ver_class = 'OK';
                $check=1;
            }
            $function='OK';
            if(!function_exists('file_put_contents')){
                $function='WARN';
                $fstr.="<span class='error'>空间不支持file_put_contents函数，系统无法写文件。</span>";
            }
            if(!function_exists('fsockopen')&&!function_exists('pfsockopen')&&!function_exists('stream_socket_client')){
                $function='WARN';
                $fstr.="<span class='error'>空间不支持fsockopen，pfsockopen,stream_socket_client函数，系统邮件功能不能使用。请至少开启其中一个。</span>";
            }
            if(!function_exists('copy')){
                $function='WARN';
                $fstr.="<span class='error'>空间不支持copy函数，无法上传文件。</span>";
            }
            if(!function_exists('fsockopen')&&!function_exists('pfsockopen')&&(!get_extension_funcs('curl')||!function_exists('curl_init')||!function_exists('curl_setopt')||!function_exists('curl_exec')||!function_exists('curl_close'))){
                $function='WARN';
                $fstr.="<span class='error'>空间不支持fsockopen，pfsockopen函数，curl模块(需同时开启curl_init,curl_setopt,curl_exec,curl_close)，系统在线更新，短信发送功能无法使用。请至少开启其中一个。</span>";
            }
            if(!get_extension_funcs('gd')){
                $function='WARN';
                $fstr.="<span class='error'>空间不支持gd模块，图片打水印和缩略生成功能无法使用。</span>";
            }
            if(!function_exists('gzinflate')){
                $function='WARN';
                $fstr.="<span class='error'>空间不支持gzinflate函数，无法在线解压ZIP文件。（无法通过后台上传模板和数据备份文件）</span>";
            }
            if(!function_exists('ini_set')){
                $function='WARN';
                $fstr.="<span class='error'>空间不支持ini_set函数，系统无法正常包含文件，导致后台会出现空白现象。</span>";
            }
            if($_SESSION['install']!='xminfo'){
                $function='WARN';
                $fstr.="<span class='error'>空间不支持session，无法登陆后台。</span>";
            }
            ?>
            <li class="<?php echo $mysql_ver_class; ?>"><span class="small">MySQL支持</span><?php echo $mysql_support; ?></li>
            <li class="<?php echo $ver_class;?>"><span class="small">PHP版本</span><?php echo $check == 1?PHP_VERSION:$errormsg['version']; ?></li>
            <li class="<?php echo $function;?>"><span class="small">函数支持正常</span><?php echo $fstr; ?></li>
        </ul>
    </fieldset>
    <fieldset style="margin-top: 10px;">
        <legend>文件和目录权限</legend>
        <p>要能正常使用XmInfo企业网站管理系统， 需要将几个文件/目录设置为 "可写"。下面是需要设置为"可写" 的目录清单， 以及建议的 chmod 设置。</p>
        <p>某些主机不允许您设置 CHMOD 777，要用666。先试最高的值，不行的话，再逐步降低该值。</p>
        <?php
        $w_check=array(
            '../',
            '../config/',
            '../config/db.php',
            '../attached/file/',
            '../attached/flash/',
            '../attached/image/',
            '../protected/runtime/',
        );
        $class_chcek=array();
        $check_msg = array();
        $count=count($w_check);
        for($i=0; $i<$count; $i++){
            if(!file_exists($w_check[$i])){
                $check_msg[$i].= '文件或文件夹不存在请上传';$check=0;
                $class_chcek[$i] = 'WARN';
            } elseif(is_writable_xm($w_check[$i])){
                $check_msg[$i].= '通 过';
                $class_chcek[$i] = 'OK';
                $check=1;
            } else{
                $check_msg[$i].='777属性检测不通过'; $check=0;
                $class_chcek[$i] = 'WARN';
            }
            if($check!=1 and $disabled!='disabled'){$disabled = 'disabled';}
        }
        ?>
        <ul class="list fileul">
            <?php
            for($i=0;$i<$count;$i++){
                ?>
                <li class="<?php echo $class_chcek[$i]; ?>"><span class="small"><?php echo $w_check[$i]; ?></span><?php echo $check_msg[$i]; ?></li>
                <?php
            }
            ?>
        </ul>
    </fieldset>

    <div class="tac" style="padding-top: 10px;padding-bottom: 10px;">
        <form method="post" id="form_install" name="form_instll" >
            <input type="hidden" name="action" value="3"/>
            <input type="button" value="重新检查" onclick="reconfirm()"/>&nbsp;&nbsp;
            <input type="submit" value="下一步"/>
        </form>
    </div>
    <div class="clear"></div>
</div>
<script>
    function reconfirm(){
        $("input[name=action]").val(2);
        document.forms['form_install'].submit();
    }
</script>
<?php
function is_writable_xm($dir){
    $str='';
    $is_dir=0;
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
?>