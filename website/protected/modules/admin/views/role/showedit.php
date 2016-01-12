<?php
require Yii::app()->basePath.'/modules/admin/util/MenuList.php';
?>
<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>用户管理</span>
    <span><i class="icon-angle-double-right"></i>管理组管理</span>
    <span><i class="icon-angle-double-right"></i><?php echo $id == 0?"添加管理组":"编辑管理组"; ?></span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form action="index.php?r=admin/role/edit" method="post" id="form_edit" name="form_edit">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
        <table class="form">
            <tr>
                <td class="col1"><label>组名</label><span class="red">*</span></td>
                <td><input type="text" name="rolename" value="<?php echo empty($role)?"":$role['rolename']; ?>" class="control"></td>
            </tr>
            <tr>
                <td class="col1"><label>全选</label></td>
                <td><input type="checkbox" name="permission_ckall" onclick="triggerCKAll()" /> </td>
            </tr>
            <?php
            foreach($MenuList as $m){
                ?>
                <tr>
                    <td colspan="2">
                      <!--  <label><input type="checkbox" class="permission" name="permission[]" value="<?php /*echo $m['url']; */?>" /><?php /*echo $m['name']; */?></label>-->

                        <?php
                        if(empty($permissions)){
                            ?>
                        <label><input type="checkbox" class="permission" name="permission[]" value="<?php echo $m['url']; ?>" /><?php echo $m['name']; ?></label>
                        <?php
                        }else{
                            $cked = in_array($m['url'],$permissions)?"checked='checked'":"";
                            ?>
                            <label><input <?php echo $cked; ?> class="permission" name="permission[]" type="checkbox" value="<?php echo $m['url']; ?>" /><?php echo $m['name']; ?></label>
                        <?php
                        }
                        ?>

                    </td>
                </tr>

                <?php
                if(sizeof($m['child'])>0){
                    foreach($m['child'] as $c){
                        ?>
                        <tr>
                            <td >
                        <?php
                        if(empty($permissions)){
                            ?>
                            <input type="checkbox" class="permission" name="permission[]" value="<?php echo $c['url']; ?>" /><?php echo $c['name']; ?>&nbsp;&nbsp;
                        <?php
                        }else{
                            $cked = in_array($c['url'],$permissions)?"checked='checked'":"";
                            ?>
                            <input <?php echo $cked; ?> class="permission" name="permission[]" type="checkbox" value="<?php echo $c['url']; ?>" /><?php echo $c['name']; ?>&nbsp;&nbsp;
                        <?php
                        }
                        ?>
                            </td>
                            <td>
                                <?php
                                if(sizeof($c['actions'])>0){
                                    foreach($c['actions'] as $a){
                                        if(empty($permissions)){
                                            ?>
                                            <input type="checkbox" class="permission" name="permission[]" value="<?php echo $a['url']; ?>" /><?php echo $a['name']; ?>&nbsp;&nbsp;
                                        <?php
                                        }else{
                                            $cked = in_array($a['url'],$permissions)?"checked='checked'":"";
                                            ?>
                                            <input <?php echo $cked; ?> type="checkbox" class="permission" name="permission[]" value="<?php echo $a['url']; ?>" /><?php echo $a['name']; ?>&nbsp;&nbsp;
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
            <tr>
                <td></td>
                <td>
                    <input type="button" value="保存" class="ui-button ui-widget ui-state-default " onclick="save()">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>
<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    function triggerCKAll(){
        var cked = $("input[name=permission_ckall]").prop("checked");
        if(cked == false){
            $(".permission").removeProp("checked");
        }else{
            $(".permission").prop("checked",true);
        }
    }
    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
</script>