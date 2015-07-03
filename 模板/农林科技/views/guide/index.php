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
                <h1 class="title"><?php echo $module['category']; ?></h1>
            </div>
            <div class=" mgb content">
                <?php echo $module['content']; ?>
            </div>
        </div>
    </div>
    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/queuemenu.php');
        ?>
    </div>
</div>