<?php
$APPCONFIG = Yii::app()->getParams()['APPCONFIG'];
$TITLE =  Yii::app()->getParams()['TITLE'];
$APPKEYWORDS =  Yii::app()->getParams()['APPKEYWORDS'];
$APPDESCRIPTION =  Yii::app()->getParams()['APPDESCRIPTION'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $TITLE==null?"":$TITLE."&nbsp;-&nbsp;"; ?><?php echo $APPCONFIG['webname']; ?>&nbsp;-&nbsp;POWERED BY X-MAI.COM</title>
    <meta name="keywords" content="<?php echo $APPKEYWORDS ==null?"":$APPKEYWORDS.",";  ?><?php echo $APPCONFIG['webkeyword']; ?>" />
    <meta name="description" content="<?php echo $APPDESCRIPTION ==null?"":$APPDESCRIPTION.",";  ?><?php echo $APPCONFIG['webdesc']; ?>" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/960/960.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/jquery-ui.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/external/jquery/jquery.js"></script>
    <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/favicon-20150205022924728.ico" mce_href="<?php echo Yii::app()->theme->baseUrl; ?>/css/favicon-20150205022924728.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/favicon-20150205022924728.ico" mce_href="<?php echo Yii::app()->theme->baseUrl; ?>/css/favicon-20150205022924728.ico" type="image/x-icon">
</head>
<body>
<div class="ui-widget-header ">
    <div class="container_12 ">
        <div class="grid_12 " style="line-height:50px;">
            <span class="fl"><i class="icon-volume-up"></i>
                <?php $NOTICE = Yii::app()->getParams()['NOTICE']; ?>
                <a href="<?php echo $this->getUrl('article',"view",Array('id'=>$NOTICE['article_id'])); ?>">
                    <?php
                    echo $NOTICE['title']; ?>
                </a>
            </span>
            <span class="fr">
                收藏本站
            </span>
        </div>
    </div>
</div>
<div id="topnav" class="pgt">
    <div class="container_12 mgb">
        <div class="grid_12" style="height:80px;">
            <span id="logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/img/logo.png"/></span>
            <?php
            $user = Yii::app()->session['user'];
            if($user!=null){
                ?>
                <span class="fr"><a href="<?php echo $this->getUrl('member','index') ?>"><?php echo $user['username']; ?></a>&nbsp;&nbsp;
                    <?php
                    if($user['isadmin']==1){
                        ?>
                        <a href="index.php?r=admin/console/index">后台管理</a>&nbsp;&nbsp;
                    <?php
                    }
                    ?>
                    <a href="<?php echo $this->getUrl('site','signout') ?>" title="退出"><i class="icon-signout"></i></a>
                    </span>
            <?php
            }else{
                ?>
                <span class="fr"><a href="<?php echo $this->getUrl('site','showlogin') ?>">登入</a>&nbsp;|&nbsp;<a href="<?php echo $this->getUrl('site','showregister') ?>">注册</a></span>
            <?php
            }
            ?>

        </div>
        <div class="grid_12">
            <div class="plr ui-widget-header" id="topbar" style="border:none;">
                <ul>
                    <?php
                    if($this->lang == 'zh_cn'){
                        ?>
                        <li><a <?php echo $this->home==1?"class='current'":""; ?> href="<?php echo Yii::app()->baseUrl; ?>/">首页</a></li>
                        <li class="line"></li>
                    <?php
                    }else{
                        ?>
                        <li><a <?php echo $this->home==1?"class='current'":""; ?> href="<?php echo Yii::app()->baseUrl; ?>/">HOME</a></li>
                        <li class="line"></li>
                    <?php
                    }
                    ?>

                    <?php
                    $MODULES = Yii::app()->getParams()['MODULES'];
                    foreach($MODULES as $m){
                        $top = $this->topid==$m['module_id']?"class='current'":"";
                        if($m['module']=='link'){
                            ?>
                            <li><a <?php echo $top; ?> href="<?php echo $m['url']; ?>"><?php echo $m['category']; ?></a></li>
                        <?php
                        }else{
                            ?>
                            <li><a <?php echo $top; ?> href="<?php echo $this->getUrl($m['module'],"index",Array('id'=>$m['module_id'])); ?>"><?php echo $m['category']; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="line"></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php echo $content; ?>
<div id="foot">
    <div class="container_16" style="height:160px;padding-top: 40px;" >
        <div class="grid_2 " >
            <div class="item tac">
                <ul>
                    <li><strong>关于我们</strong></li>
                    <li><a href="<?php echo $this->getUrl('guide',"index",Array('id'=>2)); ?>">小麦简介</a></li>
                    <li><a href="<?php echo $this->getUrl('guide',"index",Array('id'=>22)); ?>">联系我们</a></li>
                    <li><a href="<?php echo $this->getUrl('feedback',"index",Array('id'=>10)); ?>">问题反馈</a></li>
                </ul>
            </div>
        </div>

        <div class="grid_2 " >
            <div class="item  tac">
                <ul>
                    <li><strong>快捷导航</strong></li>
                    <li><a href="<?php echo $this->getUrl('download',"index",Array('id'=>5)); ?>">产品下载</a></li>
                    <li><a>使用教程</a></li>
                    <li><a>付款方式</a></li>
                </ul>
            </div>
        </div>
        <div class="grid_2 " >
            <div class="item  tac">
                <ul>
                    <li><strong>服务支持</strong></li>
                    <li><a>网站建设</a></li>
                    <li><a>企业方案</a></li>
                    <li><a href="<?php echo $this->getUrl('message',"index",Array('id'=>9)); ?>" >在线留言</a></li>
                </ul>
            </div>
        </div>
        <div class="grid_2 " >
            &nbsp;
        </div>

        <div class="grid_8" >
            <div class="item tar">
                <ul>
                    <li><span style="font-size:18px;font-weight: bold;"><i class="icon-phone-sign"></i>：<?php echo $APPCONFIG['webphone']; ?></span></li>
                    <li>小麦的小站&nbsp;&nbsp;版权所有&nbsp;&nbsp;<?php echo $APPCONFIG['icp']; ?></li>
                    <li>小麦的小站为您提供专业的企业建站,企业建站系统,客户关系管理系统,网站模板</li>
                    <li>Powered by XmCMS 3.0 ©20014-2015  www.x-mai.com</li>
                </ul>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    function changeLang(lang){
        alert("演示系统不展示中英文切换功能，该功能需要定制！");
        return;
        $.get('index.php?r=site/changelang',{lang:lang},function(res){
            if(res == true){
                window.location.reload();
            }
        });
    }
</script>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
</body>
</html>