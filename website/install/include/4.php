<link href="js/validate/css/validationEngine.jquery.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/validate/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/validate/jquery.validationEngine-zh_CN.js"></script>

<div class="contenttext round" style="padding:30px;">
    <form id="form_edit" name="form_edit" method="post" >
        <h1 class="title">设置超级管理员(Administrator)密码</h1>
        <fieldset>
            <legend>密码设置</legend>
            <ul class="list ulipt">
                <li><span class="small">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</span><input id="password" name="password" class="text validate[required]" type="password" />&nbsp;&nbsp;<span class="red">*</span></li>
                <li><span class="small">确认密码：</span><input id="confirm_password" name="confirm_password" class="text validate[required,equals[password]] " type="password" />&nbsp;&nbsp;<span class="red">*</span>&nbsp;&nbsp;两次输入密码必须一致！</li>
            </ul>
            <div class="tac" style="padding-top: 10px;padding-bottom: 10px;">
                <input type="hidden" name="action" value="5"/>
                <input type="button" value="保存数据库设置并继续" onclick="saveConfig()" />
            </div>
        </fieldset>
    </form>
</div>

<script>
function saveConfig(){
    if($('#form_edit').validationEngine('validate')){
        $.get('savepwd.php',{password:$("input[name=password]").val()},function(res){
            if(res == 1){
                document.forms['form_edit'].submit();
            }
        });
    }
}
</script>