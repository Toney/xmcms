<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/960/960.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/jquery-ui.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/external/jquery/jquery.js"></script>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/external/superfish/css/superfish.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/external/superfish/js/superfish.min.js"></script>
    <script>
        $(function () {
            $('#bar_list').superfish();
        });
    </script>
</head>
<body>
<div id="topnav">
    <div class="container_12 mgb">
        <div class="grid_12 mgt" style="height:60px;">
            <span id="logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/img/logo.png"/></span>

            <?php
            $user = Yii::app()->session['user'];
            if ($user != null) {
                ?>
                <span class="fr"><a
                        href="<?php echo $this->getUrl('member', 'index') ?>"><?php echo $user['username']; ?></a>&nbsp;&nbsp;
                    <?php
                    if ($user['isadmin'] == 1) {
                        ?>
                        <a href="index.php?r=admin/console/index">后台管理</a>&nbsp;&nbsp;
                    <?php
                    }
                    ?>
                    <a href="<?php echo $this->getUrl('site', 'signout') ?>" title="退出"><i class="icon-signout"></i></a>
                    </span>
            <?php
            } else {
                ?>
                <span class="fr"><a href="<?php echo $this->getUrl('site', 'showlogin') ?>">登入</a>&nbsp;|&nbsp;<a
                        href="<?php echo $this->getUrl('site', 'showregister') ?>">注册</a></span>
            <?php
            }
            ?>

        </div>

        <div class="grid_12">
            <div id="bar_top">
                <ul class="sf-menu" id="bar_list">
                    <li <?php echo $this->home == 1 ? "class='sfHover'" : ""; ?>><a
                            href="<?php echo Yii::app()->baseUrl; ?>/">首页</a></li>
                    <?php
                    $MODULES = Yii::app()->getParams()['MODULES'];
                    $i = 0;
                    foreach ($MODULES as $m) {
                        $top = $this->topid == $m['module_id'] ? "class='sfHover'" : "";
                        if ($m['module'] == 'link') {
                            ?>
                            <li <?php echo $top; ?> ><a href="<?php echo $m['url']; ?>"><?php echo $m['category']; ?></a>
                            </li>
                        <?php
                        } else {
                            ?>
                            <li <?php echo $top; ?> >
                                <a href="<?php echo $this->getUrl($m['module'], "index", Array(id => $m['module_id'])); ?>"><?php echo $m['category']; ?></a>
                                <?php
                                if (sizeof($m['cldcount']) > 0 && isset($m['childs'])) {
                                    ?>
                                    <ul>
                                        <?php
                                        for ($i = 0; $i < sizeof($m['childs']); $i++) {
                                            $c = $m['childs'][$i];
                                            $top = $this->topid == $c['module_id'] ? "class='sfHover'" : "";
                                            if ($c['module'] == 'link') {
                                                ?>
                                                <li <?php echo $top; ?>><a
                                                        href="<?php echo $c['url']; ?>"><?php echo $c['category']; ?></a>
                                                </li>
                                            <?php
                                            } else {
                                                ?>
                                                <li <?php echo $top; ?> >
                                                    <a href="<?php echo $this->getUrl($c['module'], "index", Array(id => $c['module_id'])); ?>"><?php echo $c['category']; ?>
                                                    </a>
                                                    <?php

                                                    if (sizeof($c['cldcount']) > 0 && isset($c['childs'])) {
                                                        ?>
                                                        <ul>
                                                            <?php
                                                            for ($j = 0; $j < sizeof($c['childs']); $j++) {
                                                                $cc = $c['childs'][$j];
                                                                $top = $this->topid == $c['module_id'] ? "class='sfHover'" : "";
                                                                if ($cc['module'] == 'link') {
                                                                    ?>
                                                                    <li <?php echo $top; ?> ><a
                                                                            href="<?php echo $cc['url']; ?>"><?php echo $cc['category']; ?></a>
                                                                    </li>
                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <li <?php echo $top; ?> >
                                                                        <a
                                                                            href="<?php echo $this->getUrl($cc['module'], "index", Array(id => $cc['module_id'])); ?>"><?php echo $cc['category']; ?></a>
                                                                    </li>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    <?php
                                                    }

                                                    ?>
                                                </li>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                <?php
                                }
                                ?>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        $i++;
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>
<?php echo $content; ?>
<div id="foot">
    <div class="container_16" style="height:160px;padding-top: 40px;">
        <div class="grid_2 ">
            <div class="item tac">
                <ul>
                    <li><strong>关于我们</strong></li>
                    <li><a>公司简介</a></li>
                    <li><a>联系我们</a></li>
                    <li><a>问题反馈</a></li>
                </ul>
            </div>
        </div>

        <div class="grid_2 ">
            <div class="item  tac">
                <ul>
                    <li><strong>快捷导航</strong></li>
                    <li><a>新闻动态</a></li>
                    <li><a>产品展示</a></li>
                    <li><a>荣誉资质</a></li>
                </ul>
            </div>
        </div>
        <div class="grid_2 ">
            <div class="item  tac">
                <ul>
                    <li><strong>服务支持</strong></li>
                    <li><a>服务承诺</a></li>
                    <li><a>服务流程</a></li>
                    <li><a>销售网络</a></li>
                </ul>
            </div>
        </div>
        <div class="grid_2 ">
            &nbsp;
        </div>
        <?php
        $APPCONFIG = Yii::app()->getParams()['APPCONFIG'];
        ?>
        <div class="grid_8">
            <div class="item tar">
                <ul>
                    <li><span style="font-size:18px;font-weight: bold;"><i
                                class="icon-phone-sign"></i>：<?php echo $APPCONFIG['webphone']; ?></span></li>
                    <li>实验室设备公司&nbsp;&nbsp;版权所有&nbsp;&nbsp;<?php echo $APPCONFIG['icp']; ?></li>
                    <li>实验室设备公司宣传语，实验室设备公司宣传语！</li>
                    <li>Powered by XmCMS 3.0 ©20014-2015 www.x-mai.com</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
</body>
</html>