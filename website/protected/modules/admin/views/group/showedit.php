<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>用户管理</span>
    <span><i class="icon-angle-double-right"></i>用户组管理</span>
    <span><i class="icon-angle-double-right"></i><?php echo $id == 0 ? "新建用户组" : "编辑用户组" ?></span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" action="index.php?r=admin/group/edit" method="post">
            <input type="hidden" value="<?php echo $group['id']; ?>" name="id"/>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1"><label>组名</label></td>
                    <td><input type="text" name="groupname" class="control validate[required]" value="<?php echo $group['groupname']; ?>" /> </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="button" class="ui-button ui-widget ui-state-default " onclick="save()" value="保存" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    $(function(){
        $("#form_edit").validationEngine({promptPosition:'inline',scroll:false});
    });
    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
</script>