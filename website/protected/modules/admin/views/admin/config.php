<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/css/validationEngine.jquery.css" />
<div class="hid">
    <div id="dig_updatepwd" class="dialog-form" title="修改密码" >
        <form name="form_updatepwd" id="form_updatepwd" class="p10" method="post" action="edit" >
            <table class="form">
                <tr>
                    <td class="col1">旧密码</td>
                    <td><input type="password" class="small validate[required] " name="oldpasswd" />&nbsp;&nbsp;<span class="red">*</span></td>
                </tr>
                <tr><td class="col1">登入密码</td><td><input type="password" id="newpass" name="newpass" class="small validate[required] "  />&nbsp;&nbsp;<span class="red">*</span></td></tr>
                <tr><td class="col1">确认密码</td><td><input type="password" id="newpass_confirm" name="newpass_confirm" class="small validate[required,equals[newpass]]  "  />&nbsp;&nbsp;<span class="red">*</span></td></tr>
            </table>
        </form>
    </div>
</div>


<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" method="post" action="edit" >
            <input type="hidden" value="<?php echo $userinfo['user_id']; ?>" name="user_id" />
            <table class="form">
                <tr>
                    <td class="col1">用户名</td>
                    <td><?php echo $userinfo['username']; ?></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="green">管理员基本信息</span></td>
                </tr>
                <tr>
                    <td class="col1">登入名称</td>
                    <td><?php echo $userinfo['loginname']; ?></td>
                </tr>
                <tr>
                    <td class="col1">性别</td>
                    <td>
                        <?php
                        if($userinfo['sex'] == 0){
                            ?>
                            <input type="radio" value="1" name="sex"/>男&nbsp;&nbsp;<input type="radio" value="0" name="sex" checked="checked"/>女
                        <?php
                        }else{
                            ?>
                            <input type="radio" value="1" name="sex" checked="checked"/>男&nbsp;&nbsp;<input type="radio" value="0" name="sex" />女
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="col1">电话</td>
                    <td><input type="text" class="small validate[required] " name="tel" value="<?php echo $userinfo['tel'] ?>" /></td>
                </tr>
                <tr>
                    <td class="col1">手机</td>
                    <td><input type="text" class="small validate[required] " name="phone" value="<?php echo $userinfo['phone'] ?>" /></td>
                </tr>
                <tr>
                    <td class="col1">Email</td>
                    <td><input type="text" class="small validate[required] " name="email" value="<?php echo $userinfo['email'] ?>" /></td>
                </tr>
                <tr>
                    <td class="col1">创建时间</td>
                    <td><?php echo $userinfo['createtime'] ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button class="btn" onclick="updatePwd()" >修改密码</button><button class="btn" onclick="save()" >保存</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
$(function(){
    $( "#dig_updatepwd" ).dialog({
        autoOpen: false,
        title:'修改密码',
        height: 309,
        width: 500,
        modal: true,
        resizable:false,
        draggable:false,
        buttons: {
            '确定':function(){
                if($('#form_updatepwd').validationEngine('validate')){
                    var param = {
                        user_id:$("input[name=user_id]").val(),
                        oldpasswd:$("input[name=oldpasswd]").val(),
                        newpass:$("input[name=newpass]").val()
                    };
                    var obj = this;
                    $.post('changepwd',param,function(res){
                        if(res.type == true){
                            $(obj).dialog( "close" );
                            success("密码修改成功");
                        }else{
                            alert(res.message);
                        }
                    },'json');
                }
            },
            '取消':function(){
                $( this ).dialog( "close" );
            }
        },
        close:function(){
            $("input[name=oldpasswd]").val("");
            $("input[name=newpass]").val("");
            $("input[name=newpass_confirm]").val("");
        }
    });
});
function save(){
    if($("#form_edit").validationEngine('validate')){
        document.forms['form_edit'].submit();
    }
}
function updatePwd(){
    $( "#dig_updatepwd" ).dialog("open");
}
</script>