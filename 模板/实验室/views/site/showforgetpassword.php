<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>忘记密码
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <form name="form_forgetpassword" method="post" >
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <table class="form">
                    <tr>
                        <td class="col1">邮箱<span class="red">*</span></td>
                        <td><input class="control validate[required,equals[email]]" name="email" type="text" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php $this->widget('CCaptcha',Array('showRefreshButton'=>false,'clickableImage'=>true,'id'=>'captchimage','captchaAction'=>'captcha_forgetpassword')); ?></td>
                    </tr>
                    <tr>
                        <td class="col1">验证码<span class="red">*</span></td>
                        <td><input class="control validate[required]" type="text" name="captcha_forgetpassword" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" onclick="onSubmit()" value="发送邮件"  class="ui-button ui-widget ui-state-default " />
                        </td>
                    </tr>
                </table>
            </form>
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
<script>
    $(function(){
        $("#form_forgetpassword").validationEngine({promptPosition:'inline',scroll:false});
    });
    function onSubmit(){
        if ($('#form_forgetpassword').validationEngine('validate')) {
            $.post('index.php?r=site/sendemailforforget',{
                email:$("input[name=email]").val(),
                captcha_forgetpassword:$("input[name=captcha_forgetpassword]").val(),
                "YII_CSRF_TOKEN":$("input[name=YII_CSRF_TOKEN]").val()
            },function(result){
                if(result.type== true){
                    alert(result.message);
                }else{
                    alert(result.message);
                }
            },'json');
        }
    }
</script>