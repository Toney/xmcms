<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>系统提示界面
        </div>
    </div>
</div>

<div class="container_12 mgb" style="min-height: 450px">
    <div class="grid_9 bg_white">
        <div class="p40 tac">
            <?php
            if($message['type'] == false){
                ?>
                <i class="icon-info red" style="font-size: 20px;margin-right: 5px;"></i><?php echo $message['message']; ?>
                <?php
            }else{
                ?>
                <i class="icon-ok green" style="font-size: 20px;margin-right: 5px;"></i><?php echo $message['message']; ?>
                <?php
            }
            ?>

        </div>
    </div>
    <div class="grid_3 " >
        <div class="box  bg_white">
            <div class="head ui-widget-header ">最新公告</div>
            <div class="itemlist plr">
                <ul>
                    <?php
                    foreach($lastnotice as $article){
                        ?>
                        <li><a href="<?php echo $this->getUrl($article['infotype'],"view",Array(id=>$article['article_id'])); ?>"><?php echo $article['title']; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>