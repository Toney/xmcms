<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>用户登入
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
                <?php echo CHtml::beginForm('index.php?r=site/login',null,Array('name'=>'form_login','id'=>'form_login')); ?>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                    <tr>
                        <td class="col1">用户名<span class="red">*</span></td>
                        <td><input class="control validate[required]" name="loginname" type="text" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td class="col1">密&nbsp;&nbsp;&nbsp;码<span class="red">*</span></td>
                        <td><input class="control validate[required]" name="loginpass" type="password" autocomplete="off"  /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php $this->widget('CCaptcha',Array('showRefreshButton'=>false,'clickableImage'=>true,'id'=>'captchimage','captchaAction'=>'captcha_memberlogin')); ?></td>
                    </tr>
                    <tr>
                        <td class="col1">验证码<span class="red">*</span></td>
                        <td><input class="control validate[required]" type="text" id="captch_login" name="captch_login" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" value="登入" onclick="onSubmit()" class="ui-button ui-widget ui-state-default " />&nbsp;&nbsp;
                            <input type="button" value="忘记密码" onclick="window.location.href='index.php?r=site/showforgetpassword'" class="ui-button ui-widget ui-state-default " />
                        </td>
                    </tr>
                </table>
                <?php echo CHtml::endForm(); ?>
        </div>
    </div>
    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>
</div>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/css/validationEngine.jquery.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript">
$(function(){
    $("#form_login").validationEngine({promptPosition:'inline',scroll:false});
});
function onSubmit(){
    if ($('#form_login').validationEngine('validate')) {
        $.post('index.php?r=site/login',{
            loginname:$("input[name=loginname]").val(),
            loginpass:$("input[name=loginpass]").val(),
            captchimage:$("#captch_login").val(),
            "YII_CSRF_TOKEN":$("input[name=YII_CSRF_TOKEN]").val()
        },function(result){
            if(result.type == true){
                window.location.href="index.php?r=member/index";
            }else{
                alert(result.message);
            }
        },'json');
    }
}
</script>