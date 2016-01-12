<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>订单付款
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <table class="form">
                <tr>
                    <td class="w19p"><label>订单号</label></td><td class="w31p"><?php echo $order['order_id'] ?></td>
                    <td class="w19p"><label>总金额</label></td><td class="w31p"><?php echo $order['price']; ?></td>
                </tr>
                <tr>
                    <td class="w19p"><label>数量</label></td><td class="w31p"><?php echo $order['num'] ?></td>
                    <td class="w19p"><label>创建时间</label></td><td class="w31p"><?php echo $order['createtime']; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>

</div>