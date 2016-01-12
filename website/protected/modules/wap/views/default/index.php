<div data-role="page">

    <div data-role="header" style="overflow:hidden;">
        <a href="index.php?r=wap/default/index" class="ui-btn ui-shadow ui-corner-all ui-icon-home ui-btn-icon-notext">首页</a>
        <h1><?php echo $APPCONFIG['webname']; ?></h1>
        <a href="index.php?r=wap/module/index" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">分类</a>
    </div><!-- /header -->

    <div role="main" class="ui-content">

        <div class="ui-grid-solo">
            <div class="ui-block-a">
                <img style="width: 100%;" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/img/banner_top.gif"/>
            </div>
        </div>

        <div class="ui-grid-solo">
            <div class="ui-block-a">
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <li data-role="list-divider">公司动态</li>
                    <?php
                    foreach($lastnews as $article){
                        ?>
                        <li><a href="index.php?r=wap/article/view&article_id=<?php echo $article['article_id']; ?>"><?php echo $article['title']; ?></a></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="ui-grid-solo">
            <div class="ui-block-a">
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <li data-role="list-divider">业界资讯</li>
                    <?php
                    foreach($industryInformation as $article){
                        ?>
                        <li><a href="index.php?r=wap/article/view&article_id=<?php echo $article['article_id']; ?>"><?php echo $article['title']; ?></a></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="ui-grid-solo">
            <div class="ui-block-a">
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <li data-role="list-divider">招贤纳士</li>
                    <?php
                    foreach($employ as $article){
                        ?>
                        <li><a href="index.php?r=wap/job/view&article_id=<?php echo $article['article_id']; ?>"><?php echo $article['title']; ?></a></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>

</div>