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
                                <li><a href="<?php echo $this->getUrl($l['infotype'],"view",Array(id=>$l['article_id'])); ?>">
                                        <?php echo csubstr($l['title'],0,12,'utf-8',true); ?>
                                    </a><span class="fr"><?php echo $l['createtime'] ?></span></li>
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
            <div class="head ui-widget-header ">最新下载</div>
            <div class="itemlist plr">
                <ul>
                    <?php
                    foreach($lastdownload as $download){
                        ?>
                        <li><a href="<?php echo $this->getUrl($download['infotype'],"view",Array(id=>$download['article_id'])); ?>"><?php echo $download['title']; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

</div>