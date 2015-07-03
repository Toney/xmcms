<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>查看留言</span>
    <span><i class="icon-angle-double-right"></i>留言编辑</span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" action="index.php?r=admin/message/edit" method="post" >
            <input type="hidden" name="message_id" value="<?php echo $id; ?>" />
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">作者</td>
                    <td><?php echo $message['username']; ?></td>
                </tr>
                <tr>
                    <td class="col1">标题</td>
                    <td><?php echo $message['title']; ?></td>
                </tr>
                <tr>
                    <td class="col1" style="vertical-align: top !important;"  >内容</td>
                    <td>
                        <textarea name="content" style="width:100%;height:250px;">
                            <?php echo $message['content']; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td class="col1" style="vertical-align: top !important;"  >回复</td>
                    <td>
                        <textarea name="reply" style="width:100%;height:250px;">
                            <?php echo $message['reply']; ?>
                        </textarea>
                    </td>
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
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/themes/default/default.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/css/validationEngine.jquery.css" />
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    var editor;
    var editor2;
    $(function(){
        $("#form_edit").validationEngine({promptPosition:'inline'});
        editor = initEdit("content",'message')
        editor2 = initEdit("reply",'message')
    });
    function save(){
        if($("#form_edit").validationEngine('validate')){
            editor.sync();
            editor2.sync();
            var replay = editor2.html();
            if(replay.length>0){
                document.forms['form_edit'].submit();
            }else{
                alert('回复不能为空');
            }
        }
    }
</script>