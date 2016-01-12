<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>留言列表
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
                                <li><a href="<?php echo $this->getUrl("member","message_view",Array(id=>$l['message_id'])); ?>"><?php echo $l['title'] ?></a><span class="fr"><?php echo $l['createtime'] ?></span></li>
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
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>
</div>