<!DOCTYPE html>
<html>
<head>
    <base href="<%=basePath%>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>新麦CMS&nbsp;-&nbsp;企业信息管理系统</title>
</head>
<style>
    body{
        background: none repeat scroll 0 0 #F7F3F7;
        color: #737F89;
        font-family: Tahoma,'Microsoft Yahei','Simsun',sans-serif !important;
        font-size: 12px;
    }
    .login-input-user {
        background: none repeat scroll 0 0 #FFFFFF;
        border-color: #A0A4A9 #CED3D8 #CED3D8;
        border-image: none;
        border-radius: 3px;
        border-right: 1px solid #CED3D8;
        border-style: solid;
        border-width: 1px;
        color: #B6C3C9;
        font: 19px ;
        margin-bottom: 10px;
        padding:10px 10px 10px 5px;
        width: 260px;
    }
    .login-input-pass {
        background: none repeat scroll 0 0 #FFFFFF;
        border-color: #A0A4A9 #CED3D8 #CED3D8;
        border-image: none;
        border-radius: 3px;
        border-right: 1px solid #CED3D8;
        border-style: solid;
        border-width: 1px;
        color: #B6C3C9;
        font: 19px ;
        margin-bottom: 10px;
        padding:10px 10px 10px 5px;
        width: 260px;
    }
    .loginform {
        margin: 120px auto 0;
        width:328px;
    }
    .loginform .body {
        background: none repeat scroll 0 0 #FFFFFF;
        padding: 26px 24px 46px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.13);
        width: 280px;
    }
    .loginform .log-lab {
        color: #0B2832;
        display: block;
        font-size: 14px;
        font-weight: bold;
        padding-bottom: 11px;
    }
    .loginform .button {
        border: medium none;
        color: #FFFFFF;
        font-weight: bold;
        background: none repeat scroll 0 0 #2EA2CC;
        border-color: #0074A2;
        box-shadow: 0 1px 0 rgba(120, 200, 230, 0.5) inset, 0 1px 0 rgba(0, 0, 0, 0.15);
        color: #FFFFFF;
        text-decoration: none;
        height: 30px;
        line-height: 28px;
        padding: 0 12px 2px;
        border-radius: 3px;
        border-style: solid;
        border-width: 1px;
        cursor: pointer;
        display: inline-block;
        font-size: 13px;
    }
    .tar{
        text-align: right;
    }
    .tac{
        text-align: center;
    }
    #message-error{
        background:#fff;
        height: 20px;
        line-height: 20px;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>
<body>
<div id="login" class="loginform">
    <!-- login -->
    <h1 class="tac" style="width: 325px;"><a title="基于XmCMS" href="http://www.x-mai.com/">
            <img src="../../../css/manage/login/logo.png"/>
    </a></h1>
    <?php
    if($message!=null){
        ?>
        <div class="messages">
            <div id="message-error" class="message message-error">
                <span style="color: red;">错误信息：</span><?php echo $message;?>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="body">
        <form action="index.php?r=admin/default/index" method="post" name="form_DefaultIndex" >
            <div class="form">
                <!-- fields -->
                <div class="fields">
                    <div class="field">
                        <div class="log-lab">
                            <label for="loginname">用户名：</label>
                        </div>
                        <div class="input">
                            <input type="text"  name="loginname" size="40"
                                   value="administrator" class="login-input-user" />
                        </div>
                    </div>
                    <div class="field">
                        <div class="log-lab">
                            <label for="loginpass">密&nbsp;&nbsp;码：</label>
                        </div>
                        <div class="input">
                            <input type="password" name="loginpass" size="40"
                                   value="123456" class="login-input-pass" />
                        </div>
                    </div>
                    <div class="field">
                        <br>
                    </div>
                    <div class="buttons tar">
                        <input type="submit" class="button fr" name="sub_DefaultIndex" value="登&nbsp;&nbsp;入" />
                    </div>
                </div>
                <div class="links" style="margin-top: 10px;">
                    测试账号：demo/demo
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>


