<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/css/validationEngine.jquery.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/zTree/zTreeStyle/zTreeStyle.css" />
<div id="content">
    <div class="box">
        <div class="title">
            <?php
            if($id==0){
                ?>
                <h5>内容管理>产品添加</h5>
            <?php
            }else{
                ?>
                <h5>内容管理>产品编辑</h5>
            <?php
            }
            ?>
        </div>

        <div class="form" >
            <form name="form_edit" id="form_edit" action="edit" method="post" >
                <input type="hidden" name="product_id" value="<?php echo $id; ?>" />
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
                        <td class="label">产品名称</td>
                        <td><input type="text" class="small validate[required] " name="productname" value="<?php echo $product['productname']; ?>" />&nbsp;&nbsp;<span class="red">*</span></td>
                    </tr>
                    <tr>
                        <td class="label">产品图片</td>
                        <td><input type="text" class="small" name="productimage" value="<?php echo $product['productimage']; ?>" />
                            &nbsp;&nbsp;<button class="btn" id="imageselect">选择图片</button>&nbsp;&nbsp;<button class="btn"  onclick="viewImg()">预览</button>
                            <div class="hid"><a id="prviewimg" href="<?php echo $product['productimage'];?>"><img id="imgprviewimg" src=""/></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea name="productdesc" style="width:100%;height:250px;">
                                <?php echo $product['productdesc']; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">排序</td>
                        <td>
                            <?php
                            if($id==0){
                                ?>
                                <input type="text" class="small validate[required,custom[integer]] " name="orderby" value="0"  />
                            <?php
                            }else{
                                ?>
                                <input type="text" class="small validate[required,custom[integer]] " name="orderby" value="<?php echo $product['orderby'] ?>"  />
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
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/fancybox/jquery.fancybox-1.3.4.css" />
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/fancybox/jquery.fancybox-1.3.4.js"></script>
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
            url: "../module/treeByType?type=product&moduleid=<?php echo $product['module_id']; ?>"
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

    var productdesc;
    KindEditor.ready(function(K) {
        productdesc = K.create('textarea[name="productdesc"]', {
            items:editoritem_more,
            resizeType:1,
            allowFileManager : true,
            uploadJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/upload_json.php',
            fileManagerJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/file_manager_json.php'
        });


        var editor = K.editor({
            allowFileManager : true,
            uploadJson:'<?php echo Yii::app()->request->baseUrl?>/extra/kindeditor/upload_json.php'
        });
        K('#imageselect').click(function() {
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    showRemote : false,
                    imageUrl : $("input[name=weblogo]").val(),
                    clickFn : function(url, title, width, height, border, align) {
                        $("input[name=productimage]").val(url);
                        $("#prviewimg").attr("href",url);
                        $("a#prviewimg").fancybox();
                        editor.hideDialog();
                    }
                });
            });
        });

        $("a#prviewimg").fancybox();

    });
    function save(){
        if($("input[name=module_id]").val()==undefined){
            $('#module_id').validationEngine('showPrompt', '模块不能为空', 'error', true)
            return;
        }
        if($("#form_edit").validationEngine('validate')){
            productdesc.sync();
            var description = productdesc.html();;
            if(description.length>100){
                document.forms['form_edit'].submit();
            }else{
                alert('描述至少需要100字');
            }
        }
    }
    function viewImg(){
        var productimage = $("input[name=productimage]").val();
        if(!isNull(productimage)){
            $("a#prviewimg").trigger("click");
        }else{
            alert("图片不能为空");
        }
    }
</script>