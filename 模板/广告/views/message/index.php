<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i><?php echo $module['category'] ?>
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <?php
    if(sizeof($list)>0){
        ?>
        <div class="grid_9 bg_white" >
            <div class="p20">
                <div class="box bdnone">

                    <?php

                    $i=0;
                    foreach($list as $l){
                        ?>
                        <div class="itemlist <?php echo $i%2!=0?"odd":"" ?> ">
                            <ul>
                                <li><label><?php echo $l['title'] ?></label><span class="fr"><?php echo $l['createtime'] ?></span></li>
                                <li>
                                    <?php echo $l['content']; ?>
                                </li>
                                <li>
                                    <?php echo $l['reply']; ?>
                                </li>
                            </ul>
                        </div>
                        <?php
                        $i++;

                    }
                    ?>

                </div>
                <div id="pager">
                    <?php
                    $this->widget('CLinkPager', array(
                            'header' => '',
                            'firstPageLabel' => '首页',
                            'lastPageLabel' => '末页',
                            'prevPageLabel' => '上一页',
                            'nextPageLabel' => '下一页',
                            'pages' => $pages
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/queuemenu.php');
        $user = Yii::app()->session['user'];
        ?>
    </div>
    <div class="grid_9 bg_white mgt" >
        <div class="p20">
            <form name="form_submit" id="form_submit" action="index.php?r=message/submit" method="post">
                <input type="hidden" name="module_id" value="<?php echo $cur_moduleid; ?>" />
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <table class="form">
                    <tr>
                        <td><input class="control validate[required] " style="width: 200px !important;" <?php echo $user==null?"disabled='disabled'":""; ?> name="title" type="text" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td><textarea class="control validate[required] " name="content" style="width: 500px !important;" <?php echo $user==null?"disabled='disabled'":""; ?>  ></textarea></td>
                    </tr>
                    <tr>
                        <td><?php $this->widget('CCaptcha',Array('showRefreshButton'=>false,'clickableImage'=>true,'id'=>'captcha_message','captchaAction'=>'captcha_message')); ?></td>
                    </tr>
                    <tr>
                        <td><input class="control validate[required]" <?php echo $user==null?"disabled='disabled'":""; ?> type="text" id="captcha_message" name="captcha_message" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button"  value="留言" onclick="onSubmit()" class="ui-button ui-widget ui-state-default <?php echo $user==null?"ui-state-disabled":""; ?>  " />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/css/validationEngine.jquery.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript">
    $(function(){
        $("#form_submit").validationEngine({promptPosition:'inline',scroll:false});
    });
    function onSubmit(){
        if ($('#form_submit').validationEngine('validate')) {
            document.forms['form_submit'].submit();
        }
    }
</script>