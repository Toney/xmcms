<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo empty($title)?"":$title; ?></title>
    <link href="css/admin/jqueryui/jquery-ui-1.10.0.custom.css" rel="stylesheet">
    <link href="css/admin/nav.css" rel="stylesheet">
    <link href="css/admin/960/960.css" rel="stylesheet">
    <script src="css/admin/jqueryui/jquery-1.9.0.js"></script>
    <style>
        html {overflow: hidden;}
        body{
            background: none repeat scroll 0 0 #eee;
            color: #333;
            font-family: Tahoma,"Microsoft Yahei","Simsun" !important;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .div_login{
            padding-top:60px;
        }
        label{
            font-weight: bold;
        }
        .div_form{
            background-color: #FFFFFF;
            padding: 10px;
            margin-top:20px;
        }
        table.form {
            border-collapse:collapse;
        }

        table.form td {
            vertical-align: top;
            padding:5px;
        }
        table.form td.col1{
            width: 39%;
            vertical-align:middle;
            padding-left: 10px;;
        }
        table.form label {
            font-weight:bold;
        }
        table.form input.control, table.form select.control, table.form textarea.control{
            padding: 5px 5px 6px 5px;
            border-top: 1px solid #b3b3b3;
            border-left: 1px solid #b3b3b3;
            border-right: 1px solid #eaeaea;
            border-bottom: 1px solid #eaeaea;
            font-size: 12px;
            font-family: Tahoma,"Microsoft Yahei","Simsun" !important;
            display: block;
        }
        .w200{
            width: 200px;
        }
        .red{
            color: red;
        }
        .fr{
            float: right !important;
        }
        .tar{
            text-align: right;
        }
        .tac{text-align: center;}
        #site_info{
            width: 100%;
            bottom: 0px;
            position:absolute;
            display: block;
            background: none repeat scroll 0 0 #f5f5f5;

        }
        #site_info p {
            padding-left: 20px;
            line-height: 45px;
            margin: 0px;
        }
        a {
            color: #428bca;
            font-weight:bold;
            text-decoration: none;
            cursor: pointer;
        }
        .formErrorContent{
            margin-top:10px;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
<div class=" mgb">
    <ul class="nav main">
        <li><a href="http://www.x-mai.com">POWER BY XMCMS</a></li>
        <li class="fr"><a href="http://bbs.x-mai.com">论坛</a></li>
        <li class="fr"><a href="http://www.x-mai.com">帮助</a></li>
    </ul>
</div>
<div class="container_16 div_login" >
    <div class="grid_5"><br></div>
    <div class="grid_6 ">
        <div class="tac"><img src="css/admin/img/xmcms.png" /></div>
        <div class="div_form">
            <form id="form_login" name="form_login" onsubmit="return false;">
                <table class="form">
                    <tbody>
                    <tr>
                        <td class="col1">
                            <label>后台语言</label>
                        </td>
                        <td><select name="bk_lang" class="control w200" onchange="changeBkLang(this.value)">
                                <?php
                                foreach($backlangs as $lang){
                                    if($lang['isdefault'] == 1){
                                        ?>
                                        <option selected="selected" value="<?php echo $lang['lang']; ?>"><?php echo $lang['name']; ?></option>
                                        <?php
                                    }else{
                                        ?>
                                        <option value="<?php echo $lang['lang']; ?>"><?php echo $lang['name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td class="col1">
<!--                            --><?php //echo Yii::t('admin/default/index','用户名'); ?><!--<br>-->
<!--                            --><?php //echo Yii::app()->sourceLanguage; ?><!--<br>-->
<!--                            --><?php //echo Yii::app()->language; ?>
                            <label>用户名</label><span class="red">*</span>
                        </td>
                        <td><input type="text" class=" validate[required] control w200" name="loginname" value="administrator"  autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td class="col1 ">
                            <label>密码</label><span class="red">*</span>
                        </td>
                        <td class="">
                            <input type="password" class=" validate[required] control w200" name="loginpass" value="123456" autocomplete="off"  />
                        </td>
                    </tr>
                    <tr>
                        <td class="col1 ">

                        </td>
                        <td class="">
                            <?php $this->widget('CCaptcha',Array('showRefreshButton'=>false,'clickableImage'=>true,'id'=>'captchimage','captchaAction'=>'captcha_login')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1 " style="vertical-align: top;">
                            <label>验证码</label><span class="red">*</span>
                        </td>
                        <td class="">
                            <input type="text" class=" validate[required] control w200" name="logincaptcha" id="logincaptcha"  />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="tar">
                            <button onclick="login()" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" ><span class="ui-button-icon-primary ui-icon ui-icon-check"></span><span class="ui-button-text">登入</span></button>
                            <button onclick="cancelTo()" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" ><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">取消</span></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="grid_5"><br></div>
</div>
<div id="site_info" class="mgt">
    <p>
        Copyright <a href="http://www.x-mai.com">X-MAI.COM</a>. All Rights Reserved.
    </p>
</div>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/jqueryui/jquery-ui-1.10.0.custom.min.js"></script>
<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    $(function(){
        $("#form_login").validationEngine({promptPosition:'inline',scroll:false});
    });
    function login(){
        if ($('#form_login').validationEngine('validate')) {
            $.post('index.php?r=admin/default/login',{
                'loginname':$("input[name=loginname]").val(),
                'loginpass':$("input[name=loginpass]").val(),
                'logincaptcha':$("#logincaptcha").val(),
                "YII_CSRF_TOKEN":'<?php echo Yii::app()->request->csrfToken; ?>'
            },function(result){
                $("#captchimage").trigger("click");
                if(result.type == true){
                    window.location.href="index.php?r=admin/console/index";
                }else{
                    alert(result.message);
                }
            },'json');
        }
        return;
    }
    function changeBkLang(bklang){
        $.get('index.php?r=admin/default/changebklang',{'bk_lang':bklang},function(result){
            if(result.type == true){
                window.location.reload();
            }
        },'json');
    }

</script>
</body>
</html>