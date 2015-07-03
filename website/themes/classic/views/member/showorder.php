<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>订单详情
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <form name=alipayment action=<?php echo Yii::app()->request->baseUrl?>/plugins/alipay/generate/alipayapi.php
                  method=post target="_blank">
                <input type="hidden" name="WIDout_trade_no" value="<?php echo $order['order_id']; ?>" />
                <input type="hidden" name="WIDsubject" value="<?php echo $order['order_id']; ?>"/>
                <input type="hidden" name="WIDprice" value="<?php echo $order['price']; ?>"/>
            <table class="list mgb_10">
                <tr>
                    <td class="w19p"><label>订单号</label></td><td class="w31p"><?php echo $order['order_id']; ?></td>
                    <td class="w19p"><label>总价</label></td><td class="w31p"><?php echo $order['price']; ?>￥</td>
                </tr>
                <tr>
                    <td class="w19p"><label>数量</label></td><td class="w31p"><?php echo $order['num']; ?></td>
                    <td class="w19p"><label>创建时间</label></td><td class="w31p"><?php echo $order['createtime']; ?></td>
                </tr>
                <tr>
                    <td class="w19p"><label>状态</label></td><td colspan="3" >
                        <?php
                        if($order['state']=='WAIT_BUYER_PAY'){
                            echo "代付款";
                        }else if($order['state']=='TRADE_FINISHED'){
                            echo "成交";
                        }else{
                            echo "退货";
                        }
                        ?>
                    </td>
                </tr>
            </table>

            <table class="list">
                <thead>
                    <tr class="ui-state-default">
                        <td class="w39p">商品</td>
                        <td class="tac">价格</td>
                        <td class="tac">数量</td>
                    </tr>
                </thead>
                <?php
                foreach($orderdetails as $detail){
                    ?>
                    <tr>
                        <td class="w39p"><?php echo $detail['title'] ?></td>
                        <td class="tac"><?php echo $detail['price'] ?></td>
                        <td class="tac"><?php echo $detail['num'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <div class="lh30">
                <?php
                if($od['state']==0){
                    ?>
                    <span class="fr">
                        <input type="submit" class="ui-state-default ui" value="付款" />
                    </span>
                <?php
                }
                ?>
            </div>

            </form>

        </div>
    </div>

    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>

</div>