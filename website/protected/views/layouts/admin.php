<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo empty($title)?"":$title; ?></title>
    <link href="css/admin/jqueryui/jquery-ui-1.10.0.custom.css" rel="stylesheet">
    <link href="css/admin/reset.css" rel="stylesheet">
    <link href="css/admin/960/960.css" rel="stylesheet">
    <link href="css/admin/960/grid.css" rel="stylesheet">
    <link href="css/admin/nav.css" rel="stylesheet">
    <link href="css/admin/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin/fontello/css/fontello.css">
    <link rel="stylesheet" href="css/admin/fontello/css/animation.css">
    <script src="css/admin/jqueryui/jquery-1.9.0.js"></script>
    <script src="css/admin/global.js"></script>
</head>
<body>
<?php
require Yii::app()->basePath.'/modules/admin/util/MenuList.php';
?>
<div class="container_12" style="min-height: 650px;">

    <div class="grid_12 mgb">
        <ul class="nav main">
            <li><a href="http://www.x-mai.com">POWER BY XMCMS</a></li>
            <li><a href="index.php?r=admin/console/index">后台首页</a></li>
            <?php
            foreach($MenuList as $m){
                ?>
                <li><a><?php echo $m['name']; ?></a>
                <?php
                if(sizeof($m['child'])>0){
                    echo '<ul>';
                    foreach($m['child'] as $i){
                        ?>
                        <li><a href="<?php echo $i['url']; ?>"><?php echo $i['name']; ?></a> </li>
                    <?php
                    }
                    echo '</ul>';
                }
                ?>
                </li>
            <?php
            }
            ?>

            <li class="fr mgr_10 mgl_10" style="line-height: 40px;">
                <?php
                $APP_MGRLANGS = Yii::app()->getParams()['APP_MGRLANGS'];
                ?>
                <select name="mgrlang" onchange="changeMgrLang()">
                    <?php
                    foreach($APP_MGRLANGS as $mgrlang){
                        ?>
                        <option <?php echo $this->mgrlang==$mgrlang['lang']?"selected='selected'":""; ?> value="zh_cn"><?php echo $mgrlang['name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </li>
            <li class="fr mgr_10"><a><?php echo Yii::app ()->session ['user']['loginname']; ?></a>
                <ul>
                    <li class="fr"><a href="index.php?r=admin/default/logout">个人设置</a></li>
                    <li class="fr"><a href="index.php?r=admin/default/logout">修改密码</a></li>
                    <li class="fr"><a href="javascript:clearAll();">刷新全站缓存</a></li>
                    <li class="fr"><a href="index.php?r=admin/default/logout"><i class="icon-off red"></i>退出</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <?php echo $content; ?>
</div>
<div class="hidden">
    <iframe name="ajax_iframe" id="ajax_iframe" style="display: none;"></iframe>
</div>
<div id="site_info" class="mgt">
    <p>
        Copyright <a href="http://www.x-mai.com">X-MAI.COM</a>. All Rights Reserved.
    </p>
</div>
<script src="css/admin/jqueryui/jquery-ui-1.10.0.custom.min.js"></script>
<link href="css/admin/loadmask/jquery.loadmask.css" rel="stylesheet">
<script src="css/admin/loadmask/jquery.loadmask.min.js"></script>
<link href="css/admin/jgrowl/jquery.jgrowl.min.css" rel="stylesheet">
<script src="css/admin/jgrowl/jquery.jgrowl.min.js"></script>
<script src="css/admin/json2.js"></script>
<script>
function changeMgrLang(){
    var lang = $("select[name=mgrlang]").val();
    $.get('index.php?r=admin/console/mgrlang&lang='+lang,null,function(result){
        if(result.type==true){
            window.location.reload();
        }
    },'json');
}

</script>
</body>
</html>