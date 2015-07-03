<div data-role="page">

    <div data-role="header" style="overflow:hidden;">
        <a href="javascript:window.history.go(-1);" class="ui-btn ui-shadow ui-corner-all ui-icon-back ui-btn-icon-notext">返回</a>
        <h1><?php echo $APPCONFIG['webname']; ?></h1>
        <a href="index.php?r=wap/module/index" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">分类</a>
    </div><!-- /header -->

    <div role="main" class="ui-content">

        <?php
        if(sizeof($modules)>0){
            ?>
            <div class="ui-grid-c">
                <?php
                $i=4;
                $abcd = "";
                foreach($modules as $m){
                    if($i%4==0){
                        $abcd = "a";
                    }else if($i%3==0){
                        $abcd = "b";
                    }else if($i%2==0){
                        $abcd = "c";
                    }else{
                        $abcd = "d";
                    }
                    ?>
                    <div class="ui-block-<?php echo $abcd; ?>"><input type="button" onclick="window.location.href='index.php?r=wap/<?php echo $m['module']; ?>/index&module_id=<?php echo $m['module_id']; ?>'" value="<?php echo $m['category']; ?>" /></div>
                    <?php
                    $i++;
                }
                ?>

            </div>
        <?php
        }
        ?>

        <div class="ui-grid-solo">
            <div class="ui-block-a">
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <li data-role="list-divider"><?php echo $module['category']; ?></li>
                    <?php
                    foreach($list as $article){
                        ?>
                        <li><a href="index.php?r=wap/image/view&article_id=<?php echo $article['article_id']; ?>">
                                <img src="<?php echo $article['image']['image']; ?>" style="width: 100%;height: 100%;">
                                <h2><?php echo $article['title']; ?></h2>
                                <p><?php echo csubstr(strip_tags($article['description']),0,50,'utf-8',true); ?></p>
                            </a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <?php
        $pagenow = $pages->currentPage+1;
        if($pagenow>1){
            ?>
            <a href="index.php?r=wap/image/index&module_id=<?php echo $module['module_id'] ?>&page=<?php echo $pagenow-1; ?>" class="ui-btn">上一页</a>
            <?php
        }


        if($pages->pageCount>$pagenow){
            ?>
            <a href="index.php?r=wap/image/index&module_id=<?php echo $module['module_id'] ?>&page=<?php echo $pagenow+1; ?>" class="ui-btn">下一页</a>
            <?php
        }
        ?>


    </div>

</div>
