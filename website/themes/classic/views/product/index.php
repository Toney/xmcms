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
                            $i=0;
                            foreach($list as $l){
                                ?>
                                <li class="<?php echo $i%2!=0?"odd":"" ?> ">
                                    <table class="wp100">
                                        <tr>
                                            <td style="width: 41%;">
                                                <div class="caseitem" >
                                                    <img style="display: block;" width="100%" height="260px" src="<?php echo $l->product->image; ?>" />
                                                    <div class="captain"><a href="<?php echo $this->getUrl('product',"view",Array(id=>$l['article_id'])); ?>" ><?php echo $l['title'] ?></a></div>
                                                </div>
                                            </td>
                                            <td style="vertical-align: top;" class="pdl">
                                                <h2><a href="<?php echo $this->getUrl('product',"view",Array(id=>$l['article_id'])); ?>" ><?php echo csubstr(strip_tags($l['title'] ),0,25,'utf-8',true);  ?></a></h2>
                                                <p class="info">
                                                    <?php echo csubstr(strip_tags($l['description'] ),0,260,'utf-8',true);  ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                            <?php
                                $i++;
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
            <div class="head ui-widget-header ">最新产品</div>
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


