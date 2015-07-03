<?php
require Yii::app()->basePath.'/modules/manage/util/MenuList.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/zTree/zTreeStyle/zTreeStyle.css" />
<div id="content" >
    <div class="box" >
        <div class="title">
            <h5>用户管理>管理员管理>权限设置
            </h5>
        </div>
        <div class="form" >
            <form name="form_edit" id="form_edit" method="post" action="savePermission" >
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <input type="hidden" name="admingroup_id" value="<?php echo $admingroup['admingroup_id']; ?>"/>
                <input type="hidden" name="modulepermission"/>
                <table class="form">
                    <tr>
                        <td class="label">管理组</td>
                        <td><?php echo $admingroup['groupname']; ?></td>
                    </tr>
                    <tr>
                        <td class="label">管辖范围</td>
                        <td>
                            <select name="authlang" class="small">
                                <option value="All">所有语言</option>
                                <option value="zh_cn">简体中文</option>
                                <option value="en_us">英文</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">信息权限</td>
                        <td><input type="checkbox" name="self" value="1" />只允许查看自己发表的信息</td>
                    </tr>
                    <tr>
                        <td class="label" >操作权限</td>
                        <td>
                            <input type="checkbox" name="actpermission[]" class="actpermission" value="All" />完全控制&nbsp;&nbsp;
                            <input type="checkbox" name="actpermission[]" class="actpermission" value="Add"/> 添加信息&nbsp;&nbsp;
                            <input type="checkbox" name="actpermission[]" class="actpermission" value="Edit"/>修改信息&nbsp;&nbsp;
                            <input type="checkbox" name="actpermission[]" class="actpermission" value="Del"/>删除信息
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" >栏目权限</td>
                    </tr>
                    <tr>
                        <td colspan="2" >
                            <input id="ckall" name="ckall" type="checkbox"  onclick="checkContent()" />全选
                            <?php

                            foreach($MenuList as $m){
                                ?>
                                <fieldset class="mgt_10">
                                    <legend><input type="checkbox" name="operpermission[]" class="modulecls" value="<?php echo $m['enkey']; ?>"  <?php if($m['enkey']=='sysconfig'){?> checked="checked" onclick="return false;" <?php } ?> /> <?php echo $m['name']; ?></legend>
                                    <?php
                                    if(sizeof($m['child'])>0){
                                        foreach($m['child'] as $c){
                                            if(sizeof($c['child'])>0){
                                                ?>
                                                <fieldset class="mgb_10" >
                                                    <legend><input type="checkbox" name="operpermission[]" class="modulecls" value="<?php echo $c['enkey']; ?>" /><?php echo $c['name']; ?>&nbsp;&nbsp;</legend>
                                                    <?php
                                                    foreach($c['child'] as $l){
                                                        ?>
                                                        <input type="checkbox" name="operpermission[]" class="modulecls" value="<?php echo $l['enkey']; ?>" /><?php echo $l['name']; ?>&nbsp;&nbsp;
                                                        <?php
                                                    }
                                                    ?>
                                                </fieldset>
                                                <?
                                            }else{
                                                ?>
                                                <input type="checkbox" name="operpermission[]" class="modulecls" value="<?php echo $c['enkey']; ?>" /><?php echo $c['name']; ?>&nbsp;&nbsp;
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </fieldset>
                                <?php
                            }
                            ?>

                            <!--
                            <fieldset class="mgt_10">
                                <legend><input type="checkbox" name="operpermission[]" class="modulecls" value="sysconfig" checked="checked" onclick="return false;"  /> 系统设置</legend>
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="sysconfig_basicinfo" />基本设置&nbsp;&nbsp;<input type="checkbox" name="operpermission[]" class="modulecls" value="sysconfig_upload" />上传文件管理&nbsp;&nbsp;
                            </fieldset>
                            <fieldset class="mgt_10">
                                <legend><input type="checkbox" name="operpermission[]" class="modulecls" value="pageconfig"/>界面设置</legend>
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="pageconfig_flash" />FLASH设置&nbsp;&nbsp;<input type="checkbox" name="operpermission[]" class="modulecls" value="pageconfig_online" />在线交流设置
                            </fieldset>
                            <fieldset class="mgt_10">
                                <legend><input type="checkbox" name="operpermission[]" class="modulecls" value="moduleconfig"/>栏目设置</legend>
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="moduleconfig_config" />栏目设置
                            </fieldset>
                            <fieldset class="mgt_10">
                                <legend><input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig"/>内容管理</legend>
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_content"/>基本内容<br>
                                <fieldset class="mgt_10">
                                    <legend>内容管理</legend>
                                    <input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_basic" />基本内容管理&nbsp;&nbsp;<input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_article" />文章管理&nbsp;&nbsp;
                                    <input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_product"/>产品管理&nbsp;&nbsp;<input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_download" />下载管理&nbsp;&nbsp;
                                    <input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_images" />图片管理&nbsp;&nbsp;<input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_employee" />招聘管理&nbsp;&nbsp;
                                    <input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_message" />查看留言&nbsp;&nbsp;<input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_feedback" />查看反馈&nbsp;&nbsp;
                                </fieldset>
                                <input type="checkbox" class="mgt_10 modulecls" name="operpermission[]"  value="contentconfig_foot"/>底部信息<br>
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="contentconfig_other"/>其他内容
                                <ul id="tree_cn" class="ztree mgt_10" ></ul>
                                <ul id="tree_en" class="ztree mgt_10" ></ul>
                            </fieldset>
                            <fieldset class="mgt_10">
                                <legend><input type="checkbox" name="operpermission[]" class="modulecls" value="seoconfig"/>优化推广</legend>
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="seoconfig_friendlink"/>友情链接<br>
                            </fieldset>
                            <fieldset class="mgt_10 mgb_10">
                                <legend><input type="checkbox" name="operpermission[]" class="modulecls" value="userconfig"/>用户管理</legend>
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="userconfig_user" />会员管理
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="userconfig_group"/>会员组管理
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="userconfig_admin" />管理员管理
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="userconfig_admingroup" />管理员组管理
                                <input type="checkbox" name="operpermission[]" class="modulecls" value="userconfig_config"/>个人资料
                            </fieldset>-->

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>模块选择</legend>
                                <ul id="tree_cn" class="ztree mgt_10" ></ul>
                                <ul id="tree_en" class="ztree mgt_10" ></ul>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="btn" onclick="savePermission()" >保存</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/zTree/jquery.ztree.core-3.5.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/zTree/jquery.ztree.excheck-3.5.min.js"></script>
<script>

    var authlang = '<?php echo $permission['authlang'] ?>';
    var operpermissionJSON = <?php echo $permission['operpermissionJSON']; ?>;
    var modulepermissionJSON = <?php echo $permission['modulepermissionJSON']; ?>;
    var actpermissionJSON = <?php echo $permission['actpermissionJSON']; ?>;
    <?php
    if($permission['self']==null){
    ?>
    var self =1;
    <?php
    }else{
    ?>
    var self = <?php echo $permission['self']; ?>;
    <?php
    }
    ?>


    var tree_cn = false;
    var tree_en = false;

    var tree_setting_cn = {
        data: {
            simpleData: {
                enable: true
            }
        },
        async: {
            enable: true,
            url: "../module/roletree?lang=zh_cn"
        },
        check:{
            chkStyle : "checkbox",
            enable:true
        },
        callback: {
            onAsyncSuccess:function(event, treeId, treeNode, msg){
                tree_cn = true;
            }
        }
    };

    var tree_setting_en = {
        data: {
            simpleData: {
                enable: true
            }
        },
        async: {
            enable: true,
            url: "../module/roletree?lang=en_us"
        },
        check:{
            chkStyle : "checkbox",
            enable:true
        },
        callback: {
            onAsyncSuccess:function(event, treeId, treeNode, msg){
                tree_en = false;
            }
        }
    };
    var iv;
    $(function(){
        $.fn.zTree.init($("#tree_cn"), tree_setting_cn);
        $.fn.zTree.init($("#tree_en"), tree_setting_en);

        iv = window.setInterval("initData()",1000);
    });

    function initData(){
        if(tree_cn == false || tree_en==false){
            return false;
        }

        window.clearInterval(iv);

        $("select[name=authlang]").val(authlang);

        if(operpermissionJSON.length>0){
            for(var i=0;i<operpermissionJSON.length;i++){
                $("input.modulecls[value="+operpermissionJSON[i]+"]").attr("checked","checked");
            }
        }

        if(modulepermissionJSON!=""){
            var tree_cn = $.fn.zTree.getZTreeObj("tree_cn");
            var tree_en = $.fn.zTree.getZTreeObj("tree_en");

            var moduleArray = modulepermissionJSON.split(",");
            for(var i=0;i<moduleArray.length;i++){
                var node = tree_cn.getNodeByParam("id", moduleArray[i], null);
                if(node!=null){
                    tree_cn.checkNode(node);
                }

                var node = tree_en.getNodeByParam("id", moduleArray[i], null);
                if(node!=null){
                    tree_en.checkNode(node);
                }
            }
        }

        if(actpermissionJSON.length>0){
            for(var i=0;i<actpermissionJSON.length;i++){
                $("input.actpermission[value="+actpermissionJSON[i]+"]").attr("checked","checked");
            }
        }

        if(self == 1){
            $("input[name=self]").attr("checked","checked");
        }

    }

    function savePermission(){
        var tree_cn = $.fn.zTree.getZTreeObj("tree_cn");
        var tree_en = $.fn.zTree.getZTreeObj("tree_en");

        var cncked = tree_cn.getCheckedNodes(true);
        var encked = tree_en.getCheckedNodes(true);

        var module = Array();
        if(cncked.length>0){
            for(var i=0;i<cncked.length;i++){
                module.push(cncked[i]['id']);
            }
        }
        if(encked.length>0){
            for(var i=0;i<encked.length;i++){
                module.push(encked[i]['id']);
            }
        }

        $("input[name=modulepermission]").val(module.toString());

        document.forms['form_edit'].submit();
    }

    function checkContent(){
        var ckall = $("input[name=ckall]").attr("checked");
        if(ckall == 'checked'){
            $(".modulecls").attr("checked","checked");

            var tree_cn = $.fn.zTree.getZTreeObj("tree_cn");
            tree_cn.checkAllNodes(true);

            var tree_en = $.fn.zTree.getZTreeObj("tree_en");
            tree_en.checkAllNodes(true);

        }else{
            $(".modulecls").removeAttr("checked");

            var tree_cn = $.fn.zTree.getZTreeObj("tree_cn");
            tree_cn.checkAllNodes(false);

            var tree_en = $.fn.zTree.getZTreeObj("tree_en");
            tree_en.checkAllNodes(false);
        }
    }
</script>