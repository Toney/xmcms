<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>栏目设置</span><span><i class="icon-angle-double-right"></i>栏目管理</span>
    <span><i class="icon-angle-double-right"></i>栏目编辑</span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form id="form_edit" name="form_edit" method="post" action="index.php?r=admin/module/edit">
            <input type="hidden" name="module_id" value="<?php echo $module['module_id']; ?>" />
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">
                        <label>栏目</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="category" class=" validate[required] control " value="<?php echo $module['category']; ?>"  /></td>
                </tr>
                <?php
                if(!empty($parents)){
                    ?>
                    <tr>
                        <td class="col1">
                            <label>父栏目</label>
                        </td>
                        <td><select  name="parentid" class="control" >
                                <option value="-1">—根目录</option>
                                <?php
                                if(sizeof($parents)>0){
                                    $selected = "";
                                    foreach($parents as $p){
                                        $selected = $p['module_id'] ==$module['parentid']?"selected='selected'":"";
                                        if($p['parentid']==-1){
                                            ?>
                                            <option value="<?php echo $p['module_id']; ?>" <?php echo $selected; ?> >|—<?php echo $p['category']; ?></option>
                                        <?php
                                        }else{
                                            ?>
                                            <option value="<?php echo $p['module_id']; ?>" <?php echo $selected; ?> >|——<?php echo $p['category']; ?></option>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </select></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td class="col1">
                        <label>排序</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="seq" value="<?php echo $module['seq']; ?>"  class=" validate[required,custom[integer]] control "  /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>打开方式</label>
                    </td>
                    <td><select name="target" class="control">
                            <?php
                            if($module['target']=='_self'){
                                ?>
                                <option value="_self" selected="selected">当前页</option>
                                <option value="_blank">新页面</option>
                                <?php
                            }else{
                                ?>
                                <option value="_self">当前页</option>
                                <option value="_blank" selected="selected" >新页面</option>
                                <?php
                            }
                            ?>
                    </select></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>类别</label><span class="red">*</span>
                    </td>
                    <td>
                        <?php echo $this->getModuleName($module['module']); ?>
                        <input type="hidden" name="module" value="<?php echo $module['module']; ?>"/>
                    </td>
                </tr>
                <?php
                if($module['module']=='link'){
                    //是链接
                    ?>
                    <tr>
                        <td class="col1">
                            <label>链接</label><span class="red">*</span>
                        </td>
                        <td><input type="text" name="url" class=" validate[required,custom[url]] control " value="<?php echo $module['url'] ?>"  /></td>
                    </tr>
                    <?php
                }else if($module['module']=='guide'){
                    //是内容
                    ?>
                    <tr>
                        <td class="col1">
                            <label>内容</label><span class="red">*</span>
                        </td>
                        <td>
                            <textarea name="content" id="content" style="height: 350px;width: 90%;" ><?php echo $module['content']; ?></textarea>
                            <script>
                                var editor = null;
                                $(function(){
                                    editor = initEdit("content","<?php echo $module['module']; ?>")
                                });
                            </script>
                        </td>
                    </tr>
                <?php
                }
                ?>

                <tr>
                    <td class="col1">
                        <label>是否显示</label>
                    </td>
                    <td>
                        <select name="ishid" class="control" >
                            <?php
                            if($module['ishid']==0){
                                ?>
                                <option value="0" selected="selected">是</option>
                                <option value="1">否</option>
                                <?php
                            }else{
                                ?>
                                <option value="0" >是</option>
                                <option value="1" selected="selected">否</option>
                            <?php
                            }
                            ?>

                        </select>
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
    var module = "";
    $(function(){
        module = $("input[name=module]").val();
        $("#form_edit").validationEngine({promptPosition:'inline'});
    });
    function save(){
        if($("#form_edit").validationEngine('validate')){
            //当模块未内容类型的时候进行验证
            var content = "";
            var url = "";
            if(module=='guide'){
                editor.sync();
                var content = editor.text();
                if(content.length<10){
                    alert("内容的字符数量不能少于10个");
                    return;
                }
            }

            if(module=='link'){
                url = $("input[name=url]").val();
            }

            var param = {
                module_id:$("input[name=module_id]").val(),
                parentid:$("select[name=parentid]").val(),
                seq:$("input[name=seq]").val(),
                target:$("select[name=target]").val(),
                module:$("input[name=module]").val(),
                category:$("input[name=category]").val(),
                YII_CSRF_TOKEN:$("input[name=YII_CSRF_TOKEN]").val(),
                content:editor.html(),
                    url:url
            };
            //进行异步提交
            $.post('index.php?r=admin/module/edit',param,function(result){
                if(result.type==true){
                   success("栏目编辑成功！");
                }else{
                    alert(result.message);
                }
            },'json');
        }
    }
</script>