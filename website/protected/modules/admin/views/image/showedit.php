<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>内容管理</span><span><i class="icon-angle-double-right"></i>
        <?php echo $id==0?"新建图片":"编辑图片" ?>
    </span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" action="index.php?r=admin/image/edit" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">
                        <label>标题</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="title" class=" validate[required] control " value="<?php echo $image==null?"":$image['title'] ?>"   /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>模块</label><span class="red">*</span>
                    </td>
                    <td>
                        <select class="control" name="moduleid">
                            <?php
/*                            if(sizeof($modules)>0){
                                foreach($modules as $m){
                                    */?><!--
                                    <option value="<?php /*echo $m['module_id']; */?>"><?php /*echo $m['category']; */?></option>
                                --><?php
/*                                }
                            }
                            */?>


                            <?php
                            if(sizeof($modules)>0){
                                foreach($modules as $m){
                                    if($image['module_id']==$m['module_id']){
                                        ?>
                                        <option value="<?php echo $m['module_id']; ?>" selected="selected"><?php echo $m['category']; ?></option>
                                    <?php
                                    }else{
                                        ?>
                                        <option value="<?php echo $m['module_id']; ?>"><?php echo $m['category']; ?></option>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>内容</label><span class="red">*</span>
                    </td>
                    <td><textarea name="description" style="width: 90%;height: 300px;"><?php echo $image==null?"":$image['description'] ?></textarea></td>
                </tr>
                <tr>
                    <td class="col1 btnone">
                        <label>图片</label><span class="red">*</span>
                    </td>
                    <td class="btnone"><input type="text" name="image" id="image" class=" validate[required] control " value="<?php echo $image==null?"":$image['image'] ?>"  /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="button" value="选择图片" class="ui-button ui-state-default " id="selectImage" ></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>排序</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="seq" class=" validate[custom[integer]] control " value="<?php echo $image==null?"":$image['seq'] ?>"  /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>标签</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="tags" class=" validate[required] control " value="<?php echo $image==null?"":$image['tags'] ?>"   /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>可以出售</label>
                    </td>
                    <td>
                        <?php
                        if($image==null){
                            ?>
                            <input type="radio" name="cansale" value="0" checked="checked" />否&nbsp;&nbsp;<input type="radio" name="cansale" value="1" />是
                        <?php
                        }else{
                            ?>
                            <input type="radio" name="cansale" value="0" <?php echo $image['cansale']==0?"checked":""  ?> />否&nbsp;&nbsp;<input type="radio" name="cansale" value="1" <?php echo $image['cansale']==1?"checked":""  ?> />是
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>价格</label>
                    </td>
                    <td>
                        <?php
                        if($image==null){
                            ?>
                            <input type="text" name="price" class=" validate[custom[number]] control " value="0"/>
                        <?php
                        }else{
                            ?>
                            <input type="text" name="price" class=" validate[custom[number]] control " value="<?php echo $image['price']; ?>"/>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>推荐</label>
                    </td>
                    <td><select name="recommend" class="control">
                            <?php
                            if($image!=null&&$image['recommend']==1){
                                ?>
                                <option value="0">否</option>
                                <option value="1" selected="selected">是</option>
                            <?php
                            }else{
                                ?>
                                <option value="0">否</option>
                                <option value="1">是</option>
                            <?php
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>置顶</label>
                    </td>
                    <td><select name="top" class="control">
                            <?php
                            if($image!=null&&$image['top']==1){
                                ?>
                                <option value="0">否</option>
                                <option value="1" selected="selected">是</option>
                            <?php
                            }else{
                                ?>
                                <option value="0">否</option>
                                <option value="1">是</option>
                            <?php
                            }
                            ?>
                        </select></td>
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
    var editor1 = null;
    $(function(){
        $("#form_edit").validationEngine({promptPosition:'inline'});
        editor = initEdit("description",'image')
    });

    KindEditor.ready(function(K) {
        editor1= K.editor({
            allowFileManager : true,
            uploadJson:'css/admin/kindeditor/upload_json.php?module=image',
            fileManagerJson:'css/admin/kindeditor/file_manager_json.php?module=image'
        });
        K('#selectImage').click(function() {
            editor1.loadPlugin('image', function() {
                editor1.plugin.imageDialog({
                    imageUrl : '<?php echo $image==null?"":$image['image'] ?>',
                    clickFn : function(url, title, width, height, border, align) {
                        K('#image').val(url);
                        editor1.hideDialog();
                    }
                });
            });
        });
    });

    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
</script>