<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>片段管理</span><span><i
            class="icon-angle-double-right"></i>内容管理</span><span><i class="icon-angle-double-right"></i>
        <?php echo $id == 0 ? "新建片段" : "编辑片段" ?>
    </span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" action="index.php?r=admin/fragment/edit" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>"/>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1"><label>描述</label><span class="red">*</span></td>
                    <td><input type="text" class="control validate[required] " name="title" value="<?php echo $fragment['title']; ?>" /></td>
                </tr>
                <tr>
                    <td class="col1"><label>关键值</label><span class="red">*</span></td>
                    <td><input type="text" class="control validate[required] " name="key" value="<?php echo $fragment['key']==null?"":$fragment['key']; ?>"  /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="content" style="width:100%;height:300px;">
                            <?php echo $fragment['content']; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="button"  onclick="save()" class="ui-button ui-state-default " value="保存"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/themes/default/default.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/css/validationEngine.jquery.css" />
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    var editor = null;
    $(function(){
        $("#form_edit").validationEngine({promptPosition:'inline'});
        editor = initEdit("content",'fragment')
    });
    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
</script>