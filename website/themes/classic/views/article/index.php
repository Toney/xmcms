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
            <div class="box bdnone">
                <div class="itemlist  ">
                    <ul>
                        <?php
                        if(sizeof($list)>0){
                            foreach($list as $l){
                                ?>
                                <li><a href="<?php echo $this->getUrl($l['infotype'],"view",Array(id=>$l['article_id'])); ?>"><?php echo $l['title'] ?></a><span class="fr"><?php echo $l['createtime'] ?></span></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="pager">
                <?php
                $this->widget('CLinkPager', array(
                        'header' => '',
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '末页',
                        'prevPageLabel' => '上一页',
                        'nextPageLabel' => '下一页',
                        'pages' => $pages
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/queuemenu.php');
        ?>

        <div class="box bg_white">
            <div class="head ui-widget-header ">最新文章</div>
            <div class="itemlist plr">
                <ul>
                    <?php
                    foreach($lastarticles as $article){
                        ?>
                        <li><a href="<?php echo $this->getUrl($article['infotype'],"view",Array(id=>$article['article_id'])); ?>">
                                <?php echo csubstr($article['title'],0,12,'utf-8',true); ?>
                        </a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>