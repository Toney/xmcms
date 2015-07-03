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


                <?php
                if(sizeof($list)>0){
                    $i=0;
                    foreach($list as $l){
                        ?>
                        <div class="itemlist <?php echo $i%2!=0?"odd":"" ?> ">
                            <ul>
                                <li><label><a href="<?php echo $this->getUrl($l['infotype'],"view",Array(id=>$l['article_id'])); ?>"><?php echo $l['title'] ?></a></label><span class="fr"><?php echo $l['createtime'] ?></span></li>
                                <li>工作地点：<?php echo $l->job['place']; ?>&nbsp;&nbsp;招聘人数：<?php echo $l->job['employnum']; ?>&nbsp;&nbsp;工资：<?php echo $l->job['pay']; ?>&nbsp;&nbsp;</li>
                                <li>
                                    <?php echo csubstr(strip_tags($l['description']),0,255,"utf-8",true) ?>
                                </li>
                            </ul>
                        </div>
                        <?php
                        $i++;
                    }
                }
                ?>


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
            <div class="head ui-widget-header ">最新招聘</div>
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