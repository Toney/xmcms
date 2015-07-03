<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>订单列表
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <div class="box bdnone">

                <table class="wp100 list" >
                    <thead>
                    <tr>
                        <td style="width: 39%;">订单号</td>
                        <td class="tac">总价</td>
                        <td class="tac">数量</td>
                        <td class="tac">状态</td>
                        <td class="tac">工具</td>
                    </tr>
                    </thead>
                    <?php
                    foreach($orderlist as $od){
                        ?>
                        <tr>
                            <td class="itembb"><label><?php echo $od['order_id'] ?></label></td>
                            <td class="itembb tac"><?php echo $od['price'] ?></td>
                            <td class="itembb tac"><?php echo $od['num'] ?></td>
                            <td class="itembb tac">
                                <?php
                                if($od['state']=='WAIT_BUYER_PAY'){
                                    echo "代付款";
                                }else if($od['state']=='TRADE_FINISHED'){
                                    echo "成交";
                                }else if($od['state']=='WAIT_SELLER_SEND_GOODS'){
                                    echo "待发货";
                                }else if($od['state'] == 'WAIT_BUYER_CONFIRM_GOODS'){
                                    echo "确认收货";
                                }
                                ?></td>
                            <td class="itembb tac tooltd"><a href="<?php echo Yii::app()->request->baseUrl?>/index.php?r=member/showOrder&order_id=<?php echo $od['order_id'] ?>">详情</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>

            </div>
        </div>
    </div>

    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>

</div>