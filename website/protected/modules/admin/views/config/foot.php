<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" method="post" action="editfoot" >
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1"><label>版权信息</label></td>
                    <td><input type="text" class="control validate[required] " name="copyright" value="<?php echo $foot_array['copyright']['content']; ?>"  /></td>
                </tr>
                <tr>
                    <td class="col1"><label>地址邮编</label></td>
                    <td><input type="text" class="control validate[required] " name="postcode" value="<?php echo $foot_array['postcode']['content']; ?>"  /></td>
                </tr>
                <tr>
                    <td class="col1"><label>联系方式</label></td>
                    <td><input type="text" class="control validate[required] " name="contact" value="<?php echo $foot_array['contact']['content']; ?>" /></td>
                </tr>
                <tr>
                    <td class="col1"><label>第三方代码
                        （如统计、在线客服代码）</label></td>
                    <td><input type="text" class="control validate[required] control" name="othercode" value="<?php echo $foot_array['othercode']['content']; ?>" /></td>
                </tr>
                <tr>
                    <td class="col1" style="vertical-align: top !important;" ><label>底部其他信息</label></td>
                    <td><textarea name="otherinfo" style="width:100%;height:250px;">
                            <?php echo $foot_array['otherinfo']['content']; ?>
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
var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="otherinfo"]', {
		items:editoritem_more,
		resizeType:1,
        allowFileManager : true,
        uploadJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/upload_json.php',
        fileManagerJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/file_manager_json.php'
	});
});
function save(){
    editor.sync();
    document.forms['form_edit'].submit();
}
</script>