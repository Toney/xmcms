<?php
class OrderController extends AppAdminController {

    public function actionIndex() {

        $criteria = new CDbCriteria();
        $criteria->order = " createtime desc";
        $count = Order::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);

        $orders = Order::model()->findAll($criteria);
        $this->data['pages'] = $pager;
        $this->data['list'] = $orders;

        $this->render ('index',$this->data);
    }

    public function actionView($order_id){

        $order = $this->connection->createCommand("select * from xm_order where order_id = ".$order_id)->queryRow();
        $this->data['order'] = $order;

        $orderdetails = $this->connection->createCommand("select od.*,art.title from xm_orderdetails od
 LEFT JOIN xm_article art on od.article_id = art.article_id
where od.order_id = ".$order_id)->queryAll();
        $this->data['orderdetails'] = $orderdetails;

        $this->render ('view',$this->data);
    }

}