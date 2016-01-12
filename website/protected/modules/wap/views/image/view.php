<div data-role="page">

    <div data-role="header" style="overflow:hidden;">
        <a href="javascript:window.history.go(-1);" class="ui-btn ui-shadow ui-corner-all ui-icon-back ui-btn-icon-notext">返回</a>
        <h1><?php echo $APPCONFIG['webname']; ?></h1>
        <a href="index.php?r=wap/module/index" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">分类</a>
    </div><!-- /header -->

    <div role="main" class="ui-content">
        <h3 class="ui-bar ui-bar-a ui-corner-all"><?php echo $article['title']; ?></h3>

        <div class="ui-body ui-body-a ui-corner-all">
            <?php echo $article['description']; ?>
        </div>
    </div>

</div>