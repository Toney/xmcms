<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>用户注册
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <form name="form_register" id="form_register" method="post" action="index.php?r=site/register" >
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <table class="form">
                    <tr>
                        <td class="col1">登入名<span class="red">*</span></td>
                        <td><input class="control validate[required]" name="loginname" type="text" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td class="col1">姓名<span class="red">*</span></td>
                        <td><input class="control validate[required]" name="username" type="text" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td class="col1">性别<span class="red">*</span></td>
                        <td><select class="control validate[required]" name="sex" >
                                <option value="">请选择</option>
                                <option value="1">男</option>
                                <option value="0">女</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td class="col1">群组<span class="red">*</span></td>
                        <td><select class="control validate[required]" name="group_id" >
                                <option value="">请选择</option>
                                <?php
                                foreach($groups as $g){
                                    ?>
                                    <option value="<?php echo $g['id']; ?>"><?php echo $g['groupname']; ?></option>
                                    <?php
                                }
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td class="col1">手机<span class="red">*</span></td>
                        <td><input class="control validate[required]" name="phone" type="text" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td class="col1">电话<span class="red">*</span></td>
                        <td><input class="control validate[required]" name="tel" type="text" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td class="col1">Email<span class="red">*</span></td>
                        <td><input class="control validate[required,custom[email]]" name="email" type="text" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td class="col1">密码<span class="red">*</span></td>
                        <td><input class="control validate[required]" name="loginpass" id="loginpass" type="password" autocomplete="off"  /></td>
                    </tr>
                    <tr>
                        <td class="col1">确认密码<span class="red">*</span></td>
                        <td><input class="control validate[required,equals[loginpass]]" name="loginpass_confirm"  type="password" autocomplete="off"  /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php $this->widget('CCaptcha',Array('showRefreshButton'=>false,'clickableImage'=>true,'id'=>'captchimage','captchaAction'=>'captcha_memberregister')); ?></td>
                    </tr>
                    <tr>
                        <td class="col1">验证码<span class="red">*</span></td>
                        <td><input class="control validate[required]" type="text" name="captcha_memberregister" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" value="登入" onclick="onSubmit()" class="ui-button ui-widget ui-state-default " />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="grid_3 " >
        <div class="box  bg_white">
            <div class="head ui-widget-header ">最新公告</div>
            <div class="itemlist plr">
                <ul>
                    <?php
                    foreach($lastnotice as $article){
                        ?>
                        <li><a href="<?php echo $this->getUrl($article['infotype'],"view",Array(id=>$article['article_id'])); ?>"><?php echo $article['title']; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/css/validationEngine.jquery.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript">
    $(function(){
        $("#form_register").validationEngine({promptPosition:'inline',scroll:false});
    });
    function onSubmit(){
        if ($('#form_register').validationEngine('validate')) {
            document.forms['form_register'].submit();
        }
    }
</script>
