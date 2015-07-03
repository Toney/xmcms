<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i><?php echo $module['category'] ?>
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <?php
            $user = Yii::app()->session['user'];
            ?>
            <?php echo CHtml::beginForm('index.php?r=feedback/feedback','post',Array('name'=>'form_feedback','id'=>'form_feedback')); ?>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <input type="hidden" name="module_id" value="<?php echo $cur_moduleid; ?>"/>
            <input type="hidden" name="user_id" value="<?php echo !empty($user)?$user['user_id']:""; ?>"/>
            <table class="form">
                <tr>
                    <td class="col1">姓名<span class="red">*</span></td>
                    <td><input class="control validate[required]" name="name" value="<?php echo !empty($user)?$user['username']:'' ?>" type="text" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td class="col1">性别<span class="red">*</span></td>
                    <td><select class="control validate[required]" name="sex" >
                            <option value="">选择</option>
                            <option value="1" <?php echo !empty($user)&&$user['sex']==1?"selected='selected'":""; ?>>男</option>
                            <option value="0" <?php echo !empty($user)&&$user['sex']==0?"selected='selected'":""; ?>>女</option>
                    </select></td>
                </tr>
                <tr>
                    <td class="col1">手机<span class="red">*</span></td>
                    <td><input class="control validate[required]" name="phone" value="<?php echo !empty($user)?$user['phone']:'' ?>" type="text" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td class="col1">电话</td>
                    <td><input class="control" name="tel" type="text" value="<?php echo !empty($user)?$user['tel']:'' ?>" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td class="col1">Email</td>
                    <td><input class="control validate[custom[email]]" name="email" value="<?php echo !empty($user)?$user['email']:'' ?>" type="text" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td class="col1">反馈内容<span class="red">*</span></td>
                    <td><textarea  class="control validate[required]" style="width: 61.8% !important;" name="content" ></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php $this->widget('CCaptcha',Array('showRefreshButton'=>false,'clickableImage'=>true,'id'=>'captchimage','captchaAction'=>'captcha_feedback')); ?></td>
                </tr>
                <tr>
                    <td class="col1">验证码<span class="red">*</span></td>
                    <td><input class="control validate[required]" type="text" id="captcha_feedback" name="captcha_feedback" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="button" value="反馈" onclick="onSubmit()" class="ui-button ui-widget ui-state-default " />
                    </td>
                </tr>
            </table>
            <?php echo CHtml::endForm(); ?>

        </div>
    </div>
    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/queuemenu.php');
        ?>
    </div>
</div>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/css/validationEngine.jquery.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript">
$(function(){
    $("#form_feedback").validationEngine({promptPosition:'inline',scroll:false});
});
/*提交反馈*/
function onSubmit(){
    if ($('#form_feedback').validationEngine('validate')) {
        document.forms['form_feedback'].submit();
    }
}
</script>