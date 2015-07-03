<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/css/validationEngine.jquery.css" />
<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>系统设置</span><span><i class="icon-angle-double-right"></i>支付宝设置</span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_editalipay" id="form_editalipay" method="post" action="index.php?r=admin/config/alipayEdit"   >
            <input type="hidden" name="module" value="alipay" />
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">
                        <label>支付宝收款账号</label><span class="red">*</span>
                    </td>
                    <td><input type="text" class=" validate[required] control " name="alipay_account" value="<?php echo $config['alipay_account']['content'];?>"  /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>合作者身份(PID)</label><span class="red">*</span>
                    </td>
                    <td><input type="text" class=" validate[required] control " name="alipay_id" value="<?php echo $config['alipay_id']['content'];?>"  /></td>
                </tr>
                <tr>
                    <td class="col1">
                        <label>安全校验码</label><span class="red">*</span>
                    </td>
                    <td><input type="text" class=" validate[required] control " name="alipay_key" value="<?php echo $config['alipay_key']['content'];?>"  /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="button"  onclick="saveAlipayConfig()" class="ui-button ui-state-default " value="保存"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
function saveAlipayConfig(){
    if($("#form_editalipay").validationEngine('validate')){
        document.forms['form_editalipay'].submit();
    }
}
</script>