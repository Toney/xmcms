<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>反馈信息
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">

            <div class=" mgb content">
                <?php echo $feedback->content; ?>
            </div>
            <div class=" mgb content">
                已读：<?php echo $feedback->haveread == 1 ?"已读":"未读"; ?>
            </div>
            <div class=" mgb lightgray">
                创建时间：<?php echo $feedback->createtime; ?>
            </div>

        </div>
    </div>
    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>
</div>