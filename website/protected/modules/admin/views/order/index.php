<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>订单列表</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <form target="_blank" method="post" action="plugins/alipay/goodsconfirm/alipayapi.php" name="alipayment">
        <input type="hidden" name="WIDtrade_no" />
        <input type="hidden" name="WIDlogistics_name" value="无需物流" />
        <input type="hidden" name="WIDinvoice_no">
        <input type="hidden" name="WIDtransport_type" value="无需物流">
        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th>订单号</th>
                <th>用户</th>
                <th>价格</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>交易号</th>
                <th class="w80">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($list) > 0) {
                foreach ($list as $l) {
                    ?>
                    <tr>
                        <td><?php echo $l['order_id']; ?></td>
                        <td><?php echo $l->user['username']; ?></td>
                        <td><?php echo $l['price']; ?></td>
                        <td>
                            <?php
                            if($l['state']=='WAIT_BUYER_PAY'){
                                echo "代付款";
                            }else if($l['state']=='TRADE_FINISHED'){
                                echo "成交";
                            }else if($l['state']=='WAIT_SELLER_SEND_GOODS'){
                                echo "待发货";
                            }else if($l['state'] == 'WAIT_BUYER_CONFIRM_GOODS'){
                                echo "确认收货";
                            }
                            ?>
                        </td>
                        <td><?php echo $l['createtime']; ?></td>
                        <td><?php echo $l['trade_no']; ?></td>
                        <td class="w80">
                            <a><i class="icon-doc" title="查看" onclick="viewOrder('<?php echo $l['order_id']; ?>')" ></i></a>
                            <a><i class="icon-edit" title="发货" onclick="truck('<?php echo $l['trade_no']; ?>')"></i></a>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>
        </form>

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
<script>
/*订单查看*/
function viewOrder(orderid){
    window.location.href="index.php?r=admin/order/view&order_id="+orderid;
}
/*订单发货*/
function truck(tradeno){
    $("input[name=WIDtrade_no]").val(tradeno);
    document.forms['alipayment'].submit();
}
</script>