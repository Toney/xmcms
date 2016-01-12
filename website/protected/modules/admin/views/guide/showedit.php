<div id="content" >
    <div class="box" >
        <div class="title">
            <h5>内容管理>内容编辑</h5>
        </div>

        <div class="form" >
            <form name="form_edit" action="edit" method="post" >
                <input type="hidden" name="module_id" value="<?php echo $module['module_id'] ?>" />
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <table class="form">
                    <tr>
                        <td class="label">模块</td>
                        <td><input type="text" class="small" readonly="readonly" value="<?php echo $module['category']; ?>" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea name="modulecontent" style="width:100%;height:250px;">
                                <?php echo $guide['description']; ?>
                            </textarea>
                        </td>
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
<link rel="stylesheet" href="../../../css/manage/plugins/kindeditor/themes/default/default.css" />
<script src="../../../css/manage/plugins/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../../css/manage/plugins/kindeditor/lang/zh_CN.js"></script>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="modulecontent"]', {
            items:editoritem_more,
            resizeType:1,
            allowFileManager : true,
            uploadJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/upload_json.php',
            fileManagerJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/file_manager_json.php',
            newlineTag:'br'
        });
    });
    function save(){
        editor.sync();
        document.forms['form_edit'].submit();
    }
</script>
