<?php
if(file_exists("db/config.db.php")){
    unlink("db/config.db.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>小麦企业网站管理系统安装成功</title>
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
        <div class="lh30" style="height:40px;line-height:40px;"><label>小麦CMS安装成功！</label></div>
        <div class="l30">
            <a href="../index.php" style="margin-right: 10px;">网站首页</a>
            <a href="../index.php?r=admin">网站管理页面</a>
        </div>
        <div class="lh30" style="height:40px;line-height:40px;" >
            <span class="fr">Powered by <a href="http://www.x-mai.com">X-mai.com</a></span>
        </div>
    </div>
</div>
</body>
</html>