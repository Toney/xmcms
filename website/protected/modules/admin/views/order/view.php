<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>订单详情</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

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

    </div>
</div>

