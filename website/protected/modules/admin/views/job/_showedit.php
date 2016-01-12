<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/css/validationEngine.jquery.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/zTree/zTreeStyle/zTreeStyle.css" />
<div id="content">
    <div class="box">
        <div class="title">
            <h5>内容管理>招聘编辑</h5>
        </div>

        <div class="form" >
            <form name="form_edit" id="form_edit" action="edit" method="post" >
                <input type="hidden" name="employ_id" value="<?php echo $id; ?>" />
                <input type="hidden" name="current" value="<?php echo $current; ?>" />
                <table class="form">
                    <tr>
                        <td class="label">模块</td>
                        <td>
                            <input type="text" class="small validate[required] " id="parent" name="parent" onclick="showModule()" readonly="readonly" />&nbsp;&nbsp;<span class="red">*</span>
                            <input type="hidden" name="module_id" id="module_id"/>
                            <div id="content_module" class="menuContent" style="display:none; position: absolute;">
                                <ul id="tree_module" class="ztree" style="margin-top:0; width:180px; height: 300px;"></ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">标题</td>
                        <td><input type="text" class="small validate[required] " name="title" value="<?php echo $employee['title']; ?>" />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea name="description" style="width:100%;height:250px;">
                                <?php
                                $content = $employee['description'];
                                if(get_magic_quotes_gpc()){
                                    $content=stripslashes($content);
                                }
                                echo $content;
                                ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">工作地点</td>
                        <td><input type="text" class="small validate[required] " name="place" value="<?php echo $employee['place'] ?>"  />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr>
                        <td class="label">工资</td>
                        <td><input type="text" class="small validate[required] " name="pay" value="<?php echo $employee['pay'] ?>"  />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr>
                        <td class="label">招聘人数</td>
                        <td><input type="text" class="small validate[required,custom[integer]] " name="employnum" value="<?php echo $employee['employnum'] ?>"  />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr>
                        <td class="label">排序</td>
                        <td>
                            <?php
                            if($id == 0){
                                ?>
                                <input type="text" class="small validate[required,custom[integer]] " name="orderby" value="0"  />
                            <?php
                            }else{
                                ?>
                                <input type="text" class="small validate[required,custom[integer]] " name="orderby" value="<?php echo $employee['orderby'] ?>"  />
                            <?php
                            }
                            ?>
                            &nbsp;&nbsp;<span class="red">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">标签</td>
                        <td><input type="text" class="small" name="tags" value="<?php echo $tagstr; ?>" />&nbsp;&nbsp;标签之间使用,分开</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="btn" onclick="save()">保存</button></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</div>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/kindeditor/themes/default/default.css" />
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/kindeditor/lang/zh_CN.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/zTree/jquery.ztree.core-3.5.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/zTree/jquery.ztree.excheck-3.5.min.js"></script>
<script>

    var module_setting = {
        data: {
            simpleData: {
                enable: true
            }
        },
        async: {
            enable: true,
            url: "../module/treeByType?type=employee&moduleid=<?php echo $employee['module_id']; ?>"
        },
        check:{
            chkStyle: "checkbox",
            enable:true,
            chkboxType:{ "Y" : "", "N" : "" }
        },
        callback: {
            onCheck: module_onCheck,
            beforeCheck:module_beforeCheck,
            onNodeCreated:function(event, treeId, treeNode){
                if(treeNode.checked == true){
                    $("#parent").attr("value", treeNode.name);
                    $("#module_id").val(treeNode.id);
                }
            }
        }
    };
    function showModule(){
        $("body").bind("mousedown", hideZtreeContent);
        var cityObj = $("#parent");
        var cityOffset = $("#parent").offset();
        $("#content_module").slideDown("fast");
    }
    function module_onCheck(e, treeId, treeNode){
        var zTree = $.fn.zTree.getZTreeObj("tree_module");
        zTree.checkNode(treeNode, true, null, true);
        $("#parent").attr("value", treeNode.name);
        $("#module_id").val(treeNode.id);
        $("#content_module").fadeOut("fast");
    }
    function module_beforeCheck(treeId, treeNode){
        var zTree = $.fn.zTree.getZTreeObj("tree_module");
        zTree.checkAllNodes(false);
    }

    $(function(){
        $.fn.zTree.init($("#tree_module"), module_setting);
        ztree_ids.push('content_module');
    });


    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="description"]', {
            items:editoritem_more,
            resizeType:1,
            allowFileManager : true,
            uploadJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/upload_json.php',
            fileManagerJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/file_manager_json.php'
        });
    });
    function save(){
        if($("select[name=module_id]").val()==undefined){
            $('#module_id').validationEngine('showPrompt', '模块不能为空', 'error', true)
            return;
        }
        if($("#form_edit").validationEngine('validate')){
            editor.sync();
            var description = editor.html();;
            if(description.length>100){
                document.forms['form_edit'].submit();
            }else{
                alert('描述至少需要100字');
            }
        }
    }
</script>