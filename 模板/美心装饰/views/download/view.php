<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i><?php echo $module['category'] ?>
        </div>
    </div>
</div>
<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <div class="mgb">
                <h1 class="title">
                    <?php echo $article['title']; ?></h1>
            </div>
            <div class=" mgb content">
                <?php echo $article['description']; ?>
            </div>
            <div class=" mgb lightgray">
                更新时间：<?php echo $article['createtime']; ?>
            </div>

                <div class="content_foot">
                    <ul>
                        <li class="fl">上一篇：
                            <?php
                            if(empty($prevdownload)){
                                echo "没有了";
                            }else{
                                ?>
                                <a href="<?php echo $this->getUrl($prevdownload['infotype'],"view",Array(id=>$prevdownload['article_id'])); ?>"><?php echo $prevdownload['title']; ?></a>
                                <?php
                            }
                            ?>
                        </li>
                        <li class="fr">下一篇：
                            <?php
                            if(empty($nextdownload)){
                                echo "没有了";
                            }else{
                                ?>
                            <a href="<?php echo $this->getUrl($nextdownload['infotype'],"view",Array(id=>$nextdownload['article_id'])); ?>"><?php echo $nextdownload['title'] ?></a>
                                <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>

        </div>
    </div>
    <div class="grid_3 " >
        <?php
            $this->renderFile(Yii::app()->theme->viewPath.'/include/queuemenu.php');
        ?>

        <div class="box mgt bg_white">
            <div class="head ui-widget-header ">最新下载</div>
            <div class="itemlist plr">
                <ul>
                    <?php
                    foreach($lastproducts as $article){
                        ?>
                        <li><a href="<?php echo $this->getUrl($article['infotype'],"view",Array(id=>$article['article_id'])); ?>">
                                <?php echo csubstr($article['title'],0,12,'utf-8',true); ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>

