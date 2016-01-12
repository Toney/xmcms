<link href="js/validate/css/validationEngine.jquery.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/validate/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/validate/jquery.validationEngine-zh_CN.js"></script>

<link href="js/loadmask/jquery.loadmask.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/loadmask/jquery.loadmask.min.js"></script>

<div class="contenttext round" style="padding:30px;">
    <form id="form_dbconfig" name="form_dbconfig" method="post" >
        <h1 class="title">检查您的数据库设置情况，请在相应栏目仔细输入配置内容。</h1>
        <fieldset>
            <legend>数据库信息</legend>
            <ul class="list ulipt">
                <li><span class="small">数据库主机</span><input name="ip" class="text validate[required]" type="text" />&nbsp;&nbsp;<span class="red">*</span>&nbsp;&nbsp;数据库主机地址，格式，例如：127.0.0.1</li>
                <li><span class="small">端口</span><input name="port" class="text validate[required,custom[integer]]" type="text" value="3306" />&nbsp;&nbsp;<span class="red">*</span>&nbsp;&nbsp;数据库端口，例如：默认3306</li>
                <li><span class="small">数据库名</span><input name="dbname" class="text validate[required]" type="text" />&nbsp;&nbsp;<span class="red">*</span>&nbsp;&nbsp;数据库名称</li>
                <li><span class="small">数据库用户名</span><input name="username" class="text validate[required]" type="text" />&nbsp;&nbsp;<span class="red">*</span>&nbsp;&nbsp;数据库账号</li>
                <li><span class="small">数据库密码</span><input name="password" class="text validate[required]" type="text" />&nbsp;&nbsp;<span class="red">*</span>&nbsp;&nbsp;</li>
            </ul>
            <div class="tac">
                <input type="checkbox" checked="checked" disabled="disabled" value="1" name="demodata"/>安装官方演示数据
            </div>
            <div class="tac" style="padding-top: 10px;padding-bottom: 10px;">
                    <input type="hidden" name="action" value="4"/>
                    <input type="button" value="保存数据库设置并继续" onclick="saveDBConfig()" />
            </div>
        </fieldset>
    </form>
</div>
<script>
function saveDBConfig(){
    if($('#form_dbconfig').validationEngine('validate')){
        //测试数据库是否能够连接
        var param = {
            ip:$("#form_dbconfig").find("input[name=ip]").val(),
            port:$("#form_dbconfig").find("input[name=port]").val(),
            dbname:$("#form_dbconfig").find("input[name=dbname]").val(),
            username:$("#form_dbconfig").find("input[name=username]").val(),
            password:$("#form_dbconfig").find("input[name=password]").val()
        };

        $("body").mask("正在导入数据！");
        $.get('test.php',param,function(res){
            if(res == 1){
                $.get('import.php',null,function(res){
                    if(res ==1){
                        //导入成功！
                        document.forms['form_dbconfig'].submit();
                    }else{
                        alert(res);
                    }
                    $("body").unmask();
                });
            }else{
                $("body").unmask();
                alert('数据库未能连接成功！');
            }
        });
    }
}
</script>