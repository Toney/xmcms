<?php
require Yii::app()->theme->viewPath.'/include/doctype.php';
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $config_basic['webname']['content'];?></title>
    <meta name="Description" content=" add description  ... "/>
    <meta name="Keywords" content=" add keywords     ... "/>
    <?php
    require Yii::app()->theme->viewPath.'/include/htmlheader.php';
    ?>
<head>
<body>
<div id="wrap">

    <?php
    require Yii::app()->theme->viewPath.'/include/header.php';
    ?>

    <div id="content" class="fixed">
        <div id="page-header"><img src="<?php echo $flashs['item_bar'][0]['imageurl']; ?>" width="880" height="180" alt=""/>
            <div id="page-header-title"><?php echo $flashs['item_bar'][0]['title']; ?></div>
        </div>
        <div class="fixed">
            <div class="col580">
                <form action="login" class="fixed" id="contact-form" name="contact-form" method="post" onSubmit="return submitform()" >
                    <fieldset><p id="formstatus"></p>

                        <p><label for="name"><?php echo Yii::t('front','username'); ?><span class="required">*</span></label> <br> <input type="text"
                                                                                                            value=""
                                                                                                            name="name"
                                                                                                            id="name"
                                                                                                            class="text validate[required]">
                        </p>

                        <p><label for="email"><?php echo Yii::t('front','password'); ?><span class="required">*</span></label> <br> <input
                                type="password" value="" name="password" id="password" class="text validate[required]"></p>
                        <p><label for="captcha"><?php echo Yii::t('front','validcode'); ?><span class="required">*</span></label> <br> <input
                                type="text" value="" name="captcha" id="captcha" class="text validate[required]"></p>
                        <p>
                            <img src="/extra/captcha/captcha.php" id="_captcha" />
                            <a href="javascript:reloadCaptcha()" id="change-image"><?php echo Yii::t('front','catnotsee'); ?></a>
                        </p>

                        <?php
                        if($error==1){
                            ?>
                            <div class="errormsg" style="margin:25px;"><?php echo Yii::t('front','usernotexist'); ?></div>
                            <?php
                        }else if($error==2){
                            ?>
                            <div class="errormsg" style="margin:25px;"><?php echo Yii::t('front','passworderror'); ?></div>
                            <?php
                        }else if($error==3){
                            ?>
                            <div class="errormsg" style="margin:25px;"><?php echo Yii::t('front','validcodeerror'); ?></div>
                        <?php
                        }
                        ?>

                        <p><input type="submit" value="<?php echo Yii::t('front','login'); ?>" name="submit" ></p></fieldset>
                </form>
            </div>
            <div class="col280 last">
                <?php
                require Yii::app()->theme->viewPath . '/include/memberbar.php';
                ?>
            </div>
        </div>
    </div>

    <?php
    require Yii::app()->theme->viewPath.'/include/footer.php';
    ?>

</div>
<script>
function submitform(){
    if($("#contact-form").validationEngine('validate')){
        return true;
    }
    return false;
}
function reloadCaptcha(){
    document.getElementById('_captcha').src='/extra/captcha/captcha.php?'+Math.random()
}
</script>
</body>
</html>