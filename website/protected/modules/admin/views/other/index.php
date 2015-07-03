 

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" method="post" action="edit" >
            <table class="form">
                <tr>
                    <td class="col1" style="vertical-align: top !important;"  ><label>首页简介内容</label></td>
                    <td><textarea name="index_summary" class="control" style="width:100%;height:250px;">
                            <?php echo $others['index_summary']['description']; ?>
                        </textarea></td>
                </tr>
                <tr>
                    <td class="col1" style="vertical-align: top !important;" ><label>联系方式内容</label></td>
                    <td><textarea name="contact_content" class="control" style="width:100%;height:250px;">
                            <?php echo $others['contact_content']['description']; ?>
                        </textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <?php
                        if($this->actExist('Edit')){
                            ?>
                            <button class="btn" onclick="save()" >保存</button>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<link rel="stylesheet" href="../../../css/manage/plugins/kindeditor/themes/default/default.css" />
<script src="../../../css/manage/plugins/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../../css/manage/plugins/kindeditor/lang/zh_CN.js"></script>
<script>
var editor_index;
var editor_contact;
KindEditor.ready(function(K) {
	editor_index = K.create('textarea[name="index_summary"]', {
        items:editoritem_more,
        resizeType:1,
        allowFileManager : true,
        uploadJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/upload_json.php',
        fileManagerJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/file_manager_json.php',
        newlineTag:'br'
	});
	editor_contact = K.create('textarea[name="contact_content"]', {
        items:editoritem_more,
        resizeType:1,
        allowFileManager : true,
        uploadJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/upload_json.php',
        fileManagerJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/file_manager_json.php',
        newlineTag:'br'
	});
});
function save(){
    editor_index.sync();
    editor_contact.sync();
    document.forms['form_edit'].submit();
}
</script>