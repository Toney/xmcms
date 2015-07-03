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

            <div class="mgb">
                <h1 class="title"><?php echo $message->title; ?></h1>
            </div>
            <div class=" mgb content">
                <?php echo $message->content; ?>
            </div>
            <div class=" mgb content">
                管理员回复：<?php echo $message->reply; ?>
            </div>
            <div class=" mgb lightgray">
                创建时间：<?php echo $message->createtime; ?>
            </div>

        </div>
    </div>
    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>
</div>