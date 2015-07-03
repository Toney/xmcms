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
            background:#7abfe0;
            color: #333;
            font-family: Tahoma,"Microsoft Yahei","Simsun" !important;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        #tophead{
            background:#FFFFFF;
        }
        table.form tr td{
            border: none !important;
        }
        #login{
            padding:20px;
            color:#FFFFFF;
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
            width: 100%;
            border-collapse:collapse;
        }

        table.form td {
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
        .ipt{
            width:80px;
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
        a {
            color: #428bca;
            font-weight:bold;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
</head>
<body>

<div id="tophead">
    <div class="tac mgb" >
        <img style="margin-top:200px;margin-bottom: 20px;" src="css/admin/img/xmcms.png" />
    </div>
</div>

<div class="container_12" >
    <div class="grid_2 mgb">
        &nbsp;<br>
    </div>
    <div class="grid_8 mgb ">
        <div id="login">
            <form id="form_login" name="form_login" onsubmit="return false;">
                <table class="form">
                    <tbody>
                    <td>
                        <!--                            --><?php //echo Yii::t('admin/default/index','用户名'); ?><!--<br>-->
                        <!--                            --><?php //echo Yii::app()->sourceLanguage; ?><!--<br>-->
                        <!--                            --><?php //echo Yii::app()->language; ?>
                        <label>用户名</label><span class="red">*</span>
                    </td>
                    <td><input type="text" class=" validate[required] control ipt" name="loginname" value="administrator"  autocomplete="off" /></td>
                    <td>
                        <label>密码</label><span class="red">*</span>
                    </td>
                    <td >
                        <input type="password" class=" validate[required] control ipt" name="loginpass" value="" autocomplete="off"  />
                    </td>
                    <td>
                        <?php $this->widget('CCaptcha',Array('showRefreshButton'=>false,'clickableImage'=>true,'id'=>'captchimage','captchaAction'=>'captcha_login','imageOptions'=>Array('height'=>28))); ?>
                    </td>
                    <td><input type="text" class=" validate[required] control " style="width: 40px;" name="logincaptcha" id="logincaptcha"  /></td>
                    <td>
                        <button onclick="login()" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" ><span class="ui-button-icon-primary ui-icon ui-icon-check"></span><span class="ui-button-text">登入</span></button>
                    </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>

        <div style="color: #FFFFFF;" class="tac"><label>小麦网&nbsp;-&nbsp;Powered by x-mai.com</label></div>

    </div>
    <div class="grid_2 mgb">
        &nbsp;<br>
    </div>
</div>

<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/jqueryui/jquery-ui-1.10.0.custom.min.js"></script>
<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
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