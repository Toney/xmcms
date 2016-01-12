<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/css/validationEngine.jquery.css" />
<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>系统设置</span><span><i class="icon-angle-double-right"></i>基本设置</span>
</div>
<div class="grid_12 container">
    <div class="container_in">
        <form name="form_editbasic" id="form_editbasic" method="post" action="index.php?r=admin/config/basicedit" enctype="multipart/form-data"  >
            <input type="hidden" name="module" value="basic" />
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">
                        <label>网站名称</label><span class="red">*</span>
                        </td>
                    <td><input type="text" class=" validate[required] control " name="webname" value="<?php echo $basicconfig['webname']['content'];?>"  /></td>
                </tr>
                <tr>
                    <td class="col1 btnone">
                        <label>网站LOGO</label><span class="red">*</span>
                    </td>
                    <td class="btnone">
                        <input type="text" class=" validate[required] control " name="weblogo" value="<?php echo $basicconfig['weblogo']['content'];?>"  />
                    </td>
                </tr>
                <tr>
                    <td class="btnone"></td>
                    <td class="btnone">
                        <input type="file" class="block" name="image" id="image"/>
                    </td>
                </tr>
                <tr>
                    <td class=""></td>
                    <td class="">
                        <input type="button"  class="ui-button ui-state-default " value="预览" onclick="prevImage()"/>
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>网站网址</label><span class="red">*</span></td>
                    <td><input type="text" class=" validate[required] control " name="weburl" value="<?php echo $basicconfig['weburl']['content'];?>" /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>网站关键字</label><span class="red">*</span>&nbsp;&nbsp;<br><span class="gray">多个关键词请用竖线|隔开，建议3到4个关键词。</span></td>
                    <td><input type="text" class=" validate[required] control " name="webkeyword" value="<?php echo $basicconfig['webkeyword']['content']; ?>" /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>网站描述</label><span class="red">*</span><br>
                        <span class="gray">100字以内</span>
                    </td>
                    <td><textarea class="control" name="webdesc" ><?php echo $basicconfig['webdesc']['content'];?></textarea></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>ICP备案号</label><span class="red">*</span></td>
                    <td><input type="text" class=" validate[required] control " name="icp" value="<?php echo $basicconfig['icp']['content']; ?>" /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>网站联系电话</label></td>
                    <td><input type="text" class="validate[required] control " name="webtel" value="<?php echo $basicconfig['webtel']['content']; ?>" /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>网站联系手机</label><span class="red">*</span></td>
                    <td>
                            <input type="text" class=" validate[required] control " name="webphone" value="<?php echo $basicconfig['webphone']['content']; ?>" /></span>
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>网站联系Email</label><span class="red">*</span></td>
                    <td><input type="text" class=" validate[required] control " name="webemail" value="<?php echo $basicconfig['webemail']['content']; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="button"  onclick="saveBasicConfig()" class="ui-button ui-state-default " value="保存"/>
                    </td>
                </tr>
            </table>
            </form>
    </div>
</div>

<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
var module = '<?php echo $module;?>';
var message = '<?php echo $message; ?>';
$(function() {
    $("#form_editbasic").validationEngine({promptPosition:'inline'});
    if(!isNull(message)){
        success(message);
    }
});
function saveBasicConfig(){
	if($("#form_editbasic").validationEngine('validate')){
		document.forms['form_editbasic'].submit();
	}
}
function prevImage(){
    var weblogo = $("input[name=weblogo]").val();
    if(!isNull(weblogo)){
        window.open("<?php echo Yii::app()->request->baseUrl?>/"+weblogo);
    }else{
        error("图片不能为空");
    }
}
</script>