<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>信息反馈
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">

            <div class="box bdnone">
                <table class="wp100 list" >
                    <tbody>
                    <?php
                    foreach($list as $l){
                        ?>
                        <tr class="ui-state-default">
                            <td><?php echo $l['haveread']==0?"未读":"已读"; ?></td>
                            <td class="tac"><?php echo $l['createtime']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                内容：<?php echo $l['content'];?><br>
                                回复：<?php echo $l['reply'];?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
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

