<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>内容管理</span><span><i class="icon-angle-double-right"></i>
        <?php echo $id==0?"新建工作":"编辑工作" ?>
    </span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" action="index.php?r=admin/job/edit" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">
                        <label>标题</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="title" class=" validate[required] control " value="<?php echo $job==null?"":$job['title'] ?>"   /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>模块</label><span class="red">*</span>
                    </td>
                    <td>
                        <select class="control" name="moduleid">
                            <?php
                            if(sizeof($modules)>0){
                                foreach($modules as $m){
                                    ?>
                                    <option value="<?php echo $m['module_id']; ?>"><?php echo $m['category']; ?></option>
                                <?php
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
                    <td><textarea name="description" style="width: 90%;height: 300px;"><?php echo $job==null?"":$job['description'] ?></textarea></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>工作地点</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="place" class=" validate[required] control " value="<?php echo $job==null?"":$job['place'] ?>"  /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>月薪</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="pay" class=" validate[required] control " value="<?php echo $job==null?"":$job['pay'] ?>"  /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>招聘人数</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="employnum" class=" validate[custom[integer]] control " value="<?php echo $job==null?"":$job['employnum'] ?>"  /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>排序</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="seq" class=" validate[custom[integer]] control " value="<?php echo $job==null?"":$job['seq'] ?>"  /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>标签</label><span class="red">*</span>
                    </td>
                    <td><input type="text" name="tags" class=" validate[required] control " value="<?php echo $job==null?"":$job['tags'] ?>"   /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>推荐</label>
                    </td>
                    <td><select name="recommend" class="control">
                            <?php
                            if($job!=null&&$job['recommend']==1){
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
                            if($job!=null&&$job['top']==1){
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
    $(function(){
        $("#form_edit").validationEngine({promptPosition:'inline'});
        editor = initEdit("description",'job')
    });
    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
</script>