<div class="box bg_white">
    <div class="head ui-widget-header ">会员中心</div>
    <div class="itemlist plr">
        <ul>
            <li><a href="<?php echo $this->getUrl('member','index'); ?>">会员中心首页</a></li>
            <li><a href="<?php echo $this->getUrl('member','showedit'); ?>">修改基本信息</a></li>
            <li><a href="<?php echo $this->getUrl('member','order'); ?>">我的订单</a></li>
            <li><a href="<?php echo $this->getUrl('member','message'); ?>">管理留言信息</a></li>
            <li><a href="<?php echo $this->getUrl('member','feedback'); ?>">管理反馈信息</a></li>
            <li><a href="<?php echo $this->getUrl('site','signout'); ?>">安全退出</a></li>
        </ul>
    </div>
</div>
<?php
$FRAGMENT = Yii::app()->getParams()['FRAGMENT'];
?>
<div class="box mgt bg_white">
    <div class="head ui-widget-header ">联系方式</div>
    <?php
    echo $FRAGMENT['contact'];
    ?>
</div>