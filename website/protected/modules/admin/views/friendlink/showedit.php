<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>优化推广</span>
    <span><i class="icon-angle-double-right"></i>友情链接</span>
    <span><i class="icon-angle-double-right"></i>友情链接编辑</span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" action="index.php?r=admin/friendlink/edit" method="post" onsubmit="return onsubmit()" >
            <input type="hidden" name="friendlink_id" value="<?php echo $id; ?>" />
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">链接类型</td>
                    <td>
                        <?php
                        if($friendlink['linktype']==1){
                            ?>
                            <input type="radio" name="linktype" value="1" checked="checked"/>文字&nbsp;&nbsp;
                            <input type="radio" name="linktype" value="2"/>图片
                        <?php
                        }else{
                            ?>
                            <input type="radio" name="linktype" value="1"/>文字&nbsp;&nbsp;
                            <input type="radio" name="linktype" value="2" checked="checked"/>图片
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="col1"><label>网站名称</label><span class="red">*</span></td>
                    <td>
                        <input type="text" name="webname" value="<?php echo $friendlink['webname']; ?>" class="control validate[required]"/>
                    </td>
                </tr>
                <tr>
                    <td class="col1"><label>地址</label><span class="red">*</span></td>
                    <td>
                        <input type="text" name="weburl" value="<?php echo $friendlink['weburl']; ?>" class="control validate[required]"/>
                    </td>
                </tr>
                <tr>
                    <td class="col1"><label>Logo地址</label><span class="red">*</span></td>
                    <td>
                        <input type="text" name="logourl" value="<?php echo $friendlink['logourl']; ?>" class="control validate[required]"/>
                    </td>
                </tr>
                <tr>
                    <td class="col1"><label>关键字</label><span class="red">*</span></td>
                    <td>
                        <input type="text" name="keyword" value="<?php echo $friendlink['keyword']; ?>" class="control validate[required]"/>
                    </td>
                </tr>
                <tr>
                    <td class="col1"><label>排序</label><span class="red">*</span></td>
                    <td>
                        <input type="text" class="control validate[required,custom[integer]]" name="seq" value="<?php echo $friendlink['seq']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="col1">是否审核</td>
                    <td>
                        <?php
                        if($friendlink['isauth'] == 1){
                            ?>
                            <input type="checkbox" name="isauth" value="1"  checked="checked"/>
                        <?php
                        }else{
                            ?>
                            <input type="checkbox" name="isauth" value="1"  />
                        <?php
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" class="ui-button ui-widget ui-state-default "   value="保存" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    $(function(){
        $("#form_edit").validationEngine({promptPosition:'inline'});
    });
    function onsubmit(){
        if ($('#form_edit').validationEngine('validate')) {
            return true;
        }
        return false;
    }
</script>