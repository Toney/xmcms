<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>系统设置</span><span><i class="icon-angle-double-right"></i>系统邮箱设置</span>
</div>
<div class="grid_12 container">
    <div class="container_in">
        <form name="form_editemail" id="form_editemail" method="post" action="index.php?r=admin/config/editemail">
            <input type="hidden" name="module" value="email"/>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td colspan="2">
                        <span class="red">用于系统发送邮件，站内所有邮件都由该邮箱发送，所以请务必正确填写。</span>
                    </td>
                </tr>
                <tr>
                    <td class="col1">发件人姓名</td>
                    <td><input type="text" class="control validate[required] "
                               value="<?php echo $emailconfig['senduser']['content']; ?>" name="senduser"/></td>
                </tr>
                <tr>
                    <td class="col1">邮箱账号</td>
                    <td><input type="text" class="control validate[required,custom[email]] "
                               value="<?php echo $emailconfig['sendemail']['content']; ?>" name="sendemail"/></td>
                </tr>
                <tr>
                    <td class="col1">邮件SMTP服务器</td>
                    <td><input type="text" class="control validate[required] "
                               value="<?php echo $emailconfig['emailsmtp']['content']; ?>" name="emailsmtp"/></td>
                </tr>
                <tr>
                    <td class="col1">邮箱密码</td>
                    <td><input type="password" class="control validate[required] "
                               value="<?php echo $emailconfig['emailpwd']['content']; ?>" name="emailpwd"/></td>
                </tr>
                <tr>
                    <td class="col1 btnone">邮件发送测试</td>
                    <td class="btnone"><input type="text" class="control" id="testemail" name="testemail"/>

                    </td>
                </tr>
                <tr>
                    <td></td><td><input type="button" class="ui-button ui-state-default block" value="点击测试"onclick="sendEmailTest()"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="button" class="ui-button ui-state-default " value="保存"
                               onclick="saveEmailConfig()"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<link rel="stylesheet"
      href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script
    src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    var message = '<?php echo $message; ?>';
    $(function () {
        $("#form_editemail").validationEngine({promptPosition: 'inline'});
        if (message != '') {
            success(message);
        }

    });
    function sendEmailTest() {
        mask();
        var testemail = $("input[name=testemail]").val();
        if (isNull(testemail)) {
            $('#testemail').validationEngine('showPrompt', '测试邮箱不能为空');
        } else {
            $('#testemail').validationEngine('hide');
            $.get('index.php?r=admin/config/testEmail', {email: testemail}, function (res) {
                unmask();
                if (res.type == true) {
                    success('测试邮件发送成功');
                } else {
                    alert('邮件发送失败，请检查邮箱设置');
                }
            }, 'json');
        }
    }
    function saveEmailConfig() {
        if ($("#form_editemail").validationEngine('validate')) {
            document.forms['form_editemail'].submit();
        }
    }
</script>