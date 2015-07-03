<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>界面设置</span>
    <span><i class="icon-angle-double-right"></i>模板设置</span>
    <span><i class="icon-angle-double-right"></i>模板编辑</span>
</div>



<div class="grid_3  bg_white" style="height: 550px">
    <div style="padding: 20px;">
        <ul id="tree_files" class="ztree"></ul>
    </div>
</div>
<div class="grid_9  bg_white" style="height: 550px">

    <div style="padding:20px;">
        <table class="form">
            <tbody>
            <tr>
                <td style="padding: 0px !important;line-height: 0px;"><textarea name="description" class="ui" style="height:350px;width:100%;">
                    </textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="编辑" class="ui-button ui-state-default " onclick="editTemplate()">
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/admin/zTree/zTreeStyle/zTreeStyle.css" />
<!--<link rel="stylesheet" href="--><?php //echo Yii::app()->request->baseUrl?><!--/css/admin/kindeditor/themes/default/default.css" />-->
<!--<script src="--><?php //echo Yii::app()->request->baseUrl?><!--/css/admin/kindeditor/kindeditor-min.js"></script>-->
<!--<script charset="utf-8" src="--><?php //echo Yii::app()->request->baseUrl?><!--/css/admin/kindeditor/lang/zh_CN.js"></script>-->
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/zTree/jquery.ztree.core-3.5.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/zTree/jquery.ztree.excheck-3.5.min.js"></script>
<script>
var setting = {
    view: {
        selectedMulti: false
    },
    async: {
        enable: true,
        url:"index.php?r=admin/template/getFilelist&template=<?php echo $template; ?>&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>",
        autoParam:[ "loc"],
        type:'get'
    },
    callback: {
        onClick: fileTreeOnClick
    }
};

var loc = null;
function fileTreeOnClick(event, treeId, treeNode){
    if(treeNode.isParent == false){
       loc = treeNode.loc;

        var d=/\.[^\.]+$/.exec(loc);
        if(d=='.php'||d=='.css'){
            $.get('index.php?r=admin/template/getCode',{loc:loc},function(res){
                $("textarea[name=description]").val(res);
            });
        }else{
            alert("该文件类型不可编辑");
        }
    }
}

function editTemplate(){
    if(loc!=null){
        $.post('index.php?r=admin/template/settemplate',{loc:loc,htmlstr:$("textarea[name=description]").val(),'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->csrfToken; ?>'},function(res){
           if(res==1){
               success("模板编辑成功！");
           }
        });
    }else{
        alert("请选择模板！");
    }
}

$(function(){
    $.fn.zTree.init($("#tree_files"), setting);
});
</script>