<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/css/validationEngine.jquery.css" />
<div id="content" >
    <div class="box" >
        <div class="title">
            <h5>用户管理>管理员管理>
                <?php
                if($id==0){
                    echo '管理员添加';
                }else{
                    echo '管理员编辑';
                }
                ?>
            </h5>
        </div>

            <?php
            if($id!=0){
                ?>
            <div class="viewbar tar ptr10" >
                    <button class="btn" onclick="updatePwd()" >修改密码</button>
            </div>
            <?php
            }
            ?>


        <div class="form" >
            <form name="form_edit" id="form_edit" method="post" action="edit" >
                <input type="hidden" value="<?php echo $userinfo['user_id']; ?>" name="user_id" />
                <input type="hidden" value="<?php echo $current; ?>" name="current" />
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <table class="form">
                    <tr>
                        <td class="label">用户名</td>
                        <td>
                            <?php
                            if($id == 0){
                                ?>
                                <input type="text" name="username" class="small validate[required]" value="<?php echo $userinfo['username']; ?>"/>&nbsp;&nbsp;<span class="red">*</span>
                            <?php
                            }else{
                                ?>
                                <?php echo $userinfo['username']; ?>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><span class="green">管理员基本信息</span></td>
                    </tr>
                    <tr>
                        <td class="label">登入名称</td>
                        <td>
                            <?php
                            if($id == 0){
                                ?>
                                <input type="text" name="loginname" class="small validate[required]" value="<?php echo $userinfo['loginname']; ?>"/> &nbsp;&nbsp;<span class="red">*</span>
                            <?php
                            }else{
                                ?>
                                <?php echo $userinfo['loginname']; ?>
                            <?php
                            }
                            ?>

                        </td>
                    </tr>
                    <?php
                    if($id == 0){
                        ?>
                        <tr><td class="label">登入密码</td><td><input type="password" name="loginpass" id="loginpass" class="small validate[required] "  />&nbsp;&nbsp;<span class="red">*</span></td></tr>
                        <tr><td class="label">确认密码</td><td><input type="password" name="loginpass_confirm" id="loginpass_confirm" class="small validate[required,equals[loginpass]]  "  />&nbsp;&nbsp;<span class="red">*</span></td></tr>
                    <?php
                    }
                    ?>
                    <tr><td class="label">管理员群组</td><td>
                            <select class="small" name="admingroup_id">
                                <?php
                                foreach($admingroups as $g){
                                    ?>
                                    <option value="<?php echo $g['admingroup_id']; ?>"><?php echo $g['groupname']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td></tr>
                    <tr>
                        <td class="label">性别</td>
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
                        <td class="label">电话</td>
                        <td><input type="text" class="small validate[required] " name="tel" value="<?php echo $userinfo['tel'] ?>" />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr>
                        <td class="label">手机</td>
                        <td><input type="text" class="small validate[required] " name="phone" value="<?php echo $userinfo['phone'] ?>" />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td><input type="text" class="small validate[required,custom[email]] " name="email" value="<?php echo $userinfo['email'] ?>" />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr>
                        <td class="label">激活</td>
                        <td>
                            <?php
                            if($userinfo['isvalid']==1){
                                ?>
                                <input type="checkbox" name="isvalid" value="1" checked="checked" />
                            <?php
                            }else{
                                ?>
                                <input type="checkbox" name="isvalid" value="1" />
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    if($userinfo['createtime']!=""&&$userinfo['createtime']!=null){
                        ?>
                        <tr>
                            <td class="label">创建时间</td>
                            <td><?php echo $userinfo['createtime'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td><button class="btn" onclick="save()" >保存</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <div class="hid">
        <div id="dig_updatepwd" class="dialog-form" title="修改密码" >
            <form name="form_updatepwd" id="form_updatepwd" class="p10" method="post" action="edit" >
                <table class="form">
                    <tr>
                        <td class="label">旧密码</td>
                        <td><input type="password" class="small validate[required] " name="oldpasswd" />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr><td class="label">登入密码</td><td><input type="password" id="newpass" name="newpass" class="small validate[required] "  />&nbsp;&nbsp;<span class="red">*</span></td></tr>
                    <tr><td class="label">确认密码</td><td><input type="password" id="newpass_confirm" name="newpass_confirm" class="small validate[required,equals[newpass]]  "  />&nbsp;&nbsp;<span class="red">*</span></td></tr>
                </table>
            </form>
        </div>
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