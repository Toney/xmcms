<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>语言管理</span>
    <span><i class="icon-angle-double-right"></i>语言列表</span>
    <span><i class="icon-angle-double-right"></i>
        <?php
        if($lang['lang']=='xmcms'){
            echo '后台语言编辑';
        }else{
            echo '语言编辑';
        }
        ?>
        :<?php echo $lang['name']; ?>
    </span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" action="index.php?r=admin/language/edit" method="post" >
            <input type="hidden" name="id" value="<?php echo $lang['id']; ?>" />
            <input type="hidden" name="mark" value="<?php echo $lang['mark']; ?>" />
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">语言</td>
                    <td><?php echo $lang['name']; ?></td>
                </tr>
                <tr>
                    <td class="col1">启用</td>
                    <td><input name="useok" type="radio" value="1" <?php echo $lang['useok']==1?"checked='checked'":""; ?>/>是&nbsp;&nbsp;<input value="0" name="useok" type="radio"/>否 </td>
                </tr>
                <tr>
                    <td class="col1">默认语言</td>
                    <td><input type="radio" name="isdefault" value="1" <?php echo $lang['isdefault']==1?"checked='checked'":""; ?>/>是&nbsp;&nbsp;<input value="0" name="isdefault" type="radio"/>否 </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" class="ui-button ui-widget ui-state-default "   value="保存" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>