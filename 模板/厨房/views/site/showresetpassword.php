<div class="container_12 mgb">
    <div class="grid_12">
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>密码重置
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white">
        <div class="p20">
            <?php echo CHtml::beginForm('index.php?r=site/resetpassword',null,Array('name'=>'form_resetpassword','id'=>'form_resetpassword')); ?>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <input type="hidden" name="code" value="<?php echo $code; ?>"/>
            <table class="form">
                <tr>
                    <td class="col1">密码<span class="red">*</span></td>
                    <td><input class="control validate[required]" name="loginpass" id="loginpass" type="password" autocomplete="off"  /></td>
                </tr>
                <tr>
                    <td class="col1">确认密码<span class="red">*</span></td>
                    <td><input class="control validate[required,equals[loginpass]]" name="loginpass_confirm"  type="password" autocomplete="off"  /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php $this->widget('CCaptcha',Array('showRefreshButton'=>false,'clickableImage'=>true,'id'=>'captchimage','captchaAction'=>'captcha_resetpassword')); ?></td>
                </tr>
                <tr>
                    <td class="col1">验证码<span class="red">*</span></td>
                    <td><input class="control validate[required]" type="text" id="captcha_resetpassword" name="captcha_resetpassword" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="button" value="重置" onclick="onSubmit()" class="ui-button ui-widget ui-state-default " />&nbsp;&nbsp;
                    </td>
                </tr>
            </table>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
    <div class="grid_3 " >
        <div class="box  bg_white">
            <div class="head ui-widget-header ">最新公告</div>
            <div class="itemlist plr">
                <ul>
                    <?php
                    foreach($lastnotice as $article){
                        ?>
                        <li><a href="<?php echo $this->getUrl($article['infotype'],"view",Array(id=>$article['article_id'])); ?>"><?php echo $article['title']; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/css/validationEngine.jquery.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    $(function(){
        $("#form_resetpassword").validationEngine({promptPosition:'inline',scroll:false});
    });
    function onSubmit(){
        if ($('#form_resetpassword').validationEngine('validate')) {
            $.post('index.php?r=site/resetpassword',{
                loginpass:$("input[name=loginpass]").val(),
                code:$("input[name=code]").val(),
                captcha_resetpassword:$("input[name=captcha_resetpassword]").val(),
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