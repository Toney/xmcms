<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>修改基本信息
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <div class="ui-tabs ui-widget ui-widget-content ui-corner-all mgb">
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" >
                    <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" >
                        <a  class="ui-tabs-anchor"  >修改基本信息</a>
                    </li>
                </ul>
                <?php
                $user = Yii::app()->session['user'];
                ?>
                <div class="ui-tabs-panel ui-widget-content ui-corner-bottom">
                    <?php echo CHtml::beginForm('index.php?r=member/edit',null,Array('name'=>'form_memberedit','id'=>'form_memberedit')); ?>
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>" />
                    <table class="form">
                        <tr>
                            <td class="col1">用户名</td>
                            <td><?php echo $user['username']; ?></td>
                        </tr>
                        <tr>
                            <td class="col1">会员类型</td>
                            <td><?php echo $user['isadmin']==1?"管理员":$group['groupname']; ?></td>
                        </tr>
                        <tr>
                            <td class="col1">性别<span class="red">*</span></td>
                            <td><select class="control validate[required]" name="sex" >
                                    <option value="">请选择</option>
                                    <option value="1" <?php echo $user['sex']==1?"selected='selected'":"";  ?>>男</option>
                                    <option value="0" <?php echo $user['sex']==0?"selected='selected'":"";  ?>>女</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td class="col1">手机<span class="red">*</span> </td>
                            <td><input class="control validate[required]" value="<?php echo $user['phone']; ?>" name="phone" type="text" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td class="col1">电话<span class="red">*</span></td>
                            <td><input class="control validate[required]" name="tel" value="<?php echo $user['tel']; ?>" type="text" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td class="col1">Email<span class="red">*</span></td>
                            <td><input class="control validate[required,custom[email]]" value="<?php echo $user['email']; ?>" name="email" type="text" autocomplete="off" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="button" value="保存" onclick="saveBasic()" class="ui-button ui-widget ui-state-default " />
                            </td>
                        </tr>
                    </table>
                    <?php echo CHtml::endForm(); ?>
                </div>
            </div>

            <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" >
                    <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" >
                        <a  class="ui-tabs-anchor"  >密码重置</a>
                    </li>
                </ul>
                <div class="ui-tabs-panel ui-widget-content ui-corner-bottom">
                    <form name="form_resetpassword" id="form_resetpassword" >
                        <table class="form">
                            <tr>
                                <td class="col1">旧密码<span class="red">*</span></td>
                                <td><input class="control validate[required]" name="oldpass" type="text" autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td class="col1">新密码<span class="red">*</span></td>
                                <td><input class="control validate[required]" name="loginpass" id="loginpass" type="password" autocomplete="off"  /></td>
                            </tr>
                            <tr>
                                <td class="col1">确认密码<span class="red">*</span></td>
                                <td><input class="control validate[required,equals[loginpass]]" name="loginpass_confirm"  type="password" autocomplete="off"  /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="button" value="保存" onclick="savePassword()" class="ui-button ui-widget ui-state-default " />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

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
    $("#form_memberedit").validationEngine({promptPosition:'inline',scroll:false});
    $("#form_resetpassword").validationEngine({promptPosition:'inline',scroll:false});
});
function saveBasic(){
    if ($('#form_memberedit').validationEngine('validate')) {
        $.post('index.php?r=member/edit',{
            user_id:$("input[name=user_id]").val(),
            sex:$("input[name=sex]").val(),
            phone:$("input[name=phone]").val(),
            tel:$("input[name=tel]").val(),
            email:$("input[name=email]").val(),
            'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->csrfToken; ?>'
        },function(result){
            if(result.type == true){
                alert("基本信息修改成功");
            }else{
                alert(result.message);
            }
        },'json');
    }
}
function savePassword(){
    if ($('#form_resetpassword').validationEngine('validate')) {
        $.post('index.php?r=member/resetpassword',{
            oldpass:$("input[name=oldpass]").val(),
            loginpass:$("input[name=loginpass]").val(),
            'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->csrfToken; ?>'
        },function(result){
            if(result.type == true){
                alert("密码修改成功");
                $("input[name=oldpass]").val("")
                $("input[name=loginpass]").val("")
                $("input[name=loginpass_confirm]").val("")
            }else{
                alert(result.message);
            }
        },'json');
    }
}
</script>

