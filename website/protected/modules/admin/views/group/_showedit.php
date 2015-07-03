<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/css/validationEngine.jquery.css" />
<div id="content" >
    <div class="box" >
        <div class="title">
            <h5>用户管理>会员组管理</h5>
        </div>

        <div class="form" >
            <form name="form_edit" id="form_edit" action="edit" method="post" >
                <input type="hidden" name="group_id" value="<?php echo $id; ?>" />
                <table class="form">
                    <tr>
                        <td class="label">组名</td>
                        <td><input type="text" name="groupname" class="small validate[required]" value="<?php echo $group['groupname']; ?>" /> </td>
                    </tr>
                    <tr>
                        <td class="label">英文组名</td>
                        <td><input type="text" name="enname" class="small validate[required]" value="<?php echo $group['enname']; ?>" /> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="btn" onclick="save()" >保存</button></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
</script>