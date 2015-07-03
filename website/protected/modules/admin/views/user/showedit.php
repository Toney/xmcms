<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>用户管理</span><span><i
            class="icon-angle-double-right"></i>用户列表</span>
    <span><i class="icon-angle-double-right"></i><?php echo $id == 0 ? "新建用户" : "用户编辑" ?></span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <?php
        if($id != 0){
            ?>
            <div class="toolbar">
                <span class="fr">
                    <input type="button" value="修改密码" class="ui-button ui-widget ui-state-default " onclick="updatePwd()">
                </span>
            </div>
            <?php
        }
        ?>

        <form name="form_edit" id="form_edit" action="index.php?r=admin/user/edit" method="post">
            <input type="hidden" value="<?php echo $userinfo['user_id']; ?>" name="user_id"/>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1"><label>登入名称</label><span class="red">*</span></td>
                    <td>
                        <?php
                        if ($id != 0) {
                            ?>
                            <input type="text" name="loginname" class="control readonly" readonly="readonly" autocomplete="off"
                                   value="<?php echo $userinfo['loginname']; ?>"/>
                        <?php
                        } else {
                            ?>
                            <input type="text" name="loginname" class="control validate[required] " autocomplete="off"
                                   value="<?php echo $userinfo['loginname']; ?>"/>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
                if ($id == 0) {
                    ?>
                    <tr>
                        <td class="col1"><label>登入密码</label><span class="red">*</span></td>
                        <td><input type="password" name="loginpass" id="loginpass" autocomplete="off"
                                   class="control validate[required] "/></td>
                    </tr>
                    <tr>
                        <td class="col1"><label>确认密码</label><span class="red">*</span></td>
                        <td><input type="password" name="loginpass_confirm" autocomplete="off"
                                   class="control validate[required,equals[loginpass]]  "/></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td class="col1"><label>用户名</label><span class="red">*</span></td>
                    <td>
                        <?php
                        if ($id != 0){
                        ?>
                        <input type="text" value="<?php echo $userinfo['username']; ?>" class="control" name="username"
                               readonly="readonly"/></td>
                    <?php
                    } else {
                        ?>
                        <input type="text" class="control validate[required] " name="username"/></td>
                    <?php
                    }
                    ?>

                </tr>
                <tr>
                    <td class="col1"><label>所属群组</label></td>
                    <td>
                        <select class="control" name="group_id">
                            <?php
                            foreach ($groups as $g) {
                                if ($g['id'] == $userinfo['group_id']) {
                                    ?>
                                    <option value="<?php echo $g['id']; ?>"
                                            selected="selected"><?php echo $g['groupname']; ?></option>
                                <?php
                                } else {
                                    ?>
                                    <option
                                        value="<?php echo $g['id']; ?>"><?php echo $g['groupname']; ?></option>
                                <?php
                                }
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td class="col1"><label>性别</label></td>
                    <td>
                        <?php
                        if ($userinfo['sex'] == 0) {
                            ?>
                            <input type="radio" value="1" name="sex"/>男&nbsp;&nbsp;<input type="radio" value="0"
                                                                                          name="sex"
                                                                                          checked="checked"/>女
                        <?php
                        } else {
                            ?>
                            <input type="radio" value="1" name="sex" checked="checked"/>男&nbsp;&nbsp;<input type="radio"
                                                                                                            value="0"
                                                                                                            name="sex"/>女
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="col1"><label>电话</label><span class="red">*</span></td>
                    <td><input type="text" class="control validate[required] " name="tel"
                               value="<?php echo $userinfo['tel'] ?>"/></td>
                </tr>
                <tr>
                    <td class="col1"><label>手机</label><span class="red">*</span></td>
                    <td><input type="text" class="control validate[required] " name="phone"
                               value="<?php echo $userinfo['phone'] ?>"/></td>
                </tr>
                <tr>
                    <td class="col1"><label>Email</label><span class="red">*</span></td>
                    <td><input type="text" class="control validate[required,custom[email]] " name="email"
                               value="<?php echo $userinfo['email'] ?>"/></td>
                </tr>
                <tr>
                    <td class="col1"><label>激活</label></td>
                    <td>
                        <?php
                        if ($userinfo['isvalid'] == 1) {
                            ?>
                            <input type="checkbox" name="isvalid" value="1" checked="checked"/>
                        <?php
                        } else {
                            ?>
                            <input type="checkbox" name="isvalid" value="1"/>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="col1"><label>管理员</label></td>
                    <td>
                        <?php
                        if ($userinfo['isadmin'] == 1) {
                            ?>
                            <input type="checkbox" name="isadmin" value="1" checked="checked" onclick="isAdmin()"/>
                        <?php
                        } else {
                            ?>
                            <input type="checkbox" name="isadmin" value="1" onclick="isAdmin()"/>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr class="tr_role hid">
                    <td class="col1"><label>角色</label></td>
                    <td><select class="control" name="role_id">
                            <?php
                            foreach($roles as $r){
                                if($userinfo['role_id'] == $r['id']){
                                    ?>
                                    <option selected="selected" value="<?php echo $r['id']; ?>"><?php echo $r['rolename']; ?></option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['rolename']; ?></option>
                                    <?php
                                }

                            }
                            ?>
                    </select></td>
                </tr>
                <?php
                if ($userinfo['createtime'] == "" && $userinfo['createtime'] != null) {
                    ?>
                    <tr>
                        <td class="col1"><label>创建时间</label></td>
                        <td><?php echo $userinfo['createtime'] ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td></td>
                    <td>
                        <input type="button" value="保存" class="ui-button ui-widget ui-state-default " onclick="save()">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="hid">
    <div id="dig_updatepwd" class="dialog-form" title="修改密码" >
        <form name="form_updatepwd" id="form_updatepwd" class="p10" method="post" action="edit" >
            <table class="form">
                <tr><td class="col1"><label>登入密码</label><span class="red">*</span></td><td><input autocomplete="off" type="password" id="newpass" name="newpass" class="control validate[required] w200"  /></td></tr>
            </table>
        </form>
    </div>
</div>

<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    $(function(){
        $("#form_edit").validationEngine({promptPosition:'inline'});
        $("#form_updatepwd").validationEngine({promptPosition:'inline'});

        $( "#dig_updatepwd" ).dialog({
            autoOpen: false,
            title:'修改密码',
            height: 247,
            width: 400,
            modal: true,
            resizable:false,
            draggable:false,
            buttons: {
                '确定':function(){
                    if($('#form_updatepwd').validationEngine('validate')){
                        var param = {
                            user_id:$("input[name=user_id]").val(),
                            newpass:$("input[name=newpass]").val()
                        };
                        var obj = this;
                        $.post('index.php?r=admin/user/changepwd',param,function(res){
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
                $("input[name=newpass]").val("");
            }
        });
        isAdmin();
    });
    function isAdmin(){
        var cked = $("input[name=isadmin]").prop("checked");
        if(cked == true){
            $(".tr_role").show();
        }else{
            $(".tr_role").hide();
        }
    }
    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
    function updatePwd(){
        $( "#dig_updatepwd" ).dialog("open");
    }
</script>