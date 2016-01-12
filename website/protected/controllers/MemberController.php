<?php
class MemberController extends AppController
{

    public function filters() {
        $user = Yii::app ()->session ['member'];
        if($user==null){
            $this->redirect(Yii::app()->request->baseUrl.'/index.php?r=site/showlogin');
        }
    }

    public function actionIndex(){

        $user = Yii::app ()->session ['member'];
        $this->data['group'] = Group::model()->findByPk($user['group_id']);

        $this->render('index',$this->data);
    }

    /*基本信息修改页面显示*/
    function actionShowedit(){

        $user = Yii::app ()->session ['member'];
        $this->data['user'] = $this->connection->createCommand("select * from xm_user where user_id = {$user['user_id']}")->queryRow();
        $this->data['group'] = Group::model()->findByPk($user['group_id']);

        $this->render('showedit',$this->data);
    }

    /*基本信息修改操作*/
    function actionEdit(){

        $user = Yii::app ()->session ['member'];

        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $sex = $_POST['sex'];

        $this->connection->createCommand("update xm_user set phone = '{$phone}',email='{$email}',tel='{$tel}',sex='{$sex}' where user_id = {$user['user_id']}")->query();

        $this->message(true,"用户信息修改成功");
    }

    /*密码重置*/
    public function actionResetpassword(){
        $user = Yii::app ()->session ['member'];

        $loginpass = $_POST['loginpass'];
        $oldpass = $_POST['oldpass'];

        $user_db = $this->connection->createCommand("select * from xm_user where user_id = {$user['user_id']}")->queryRow();

        if($user_db['loginpass'] == md5($oldpass)){

            $this->connection->createCommand("update xm_user set loginpass = '".md5($loginpass)."' where user_id  = {$user['user_id']}")->execute();

            $this->message(true,"密码修改成功！");
        }else{
            $this->message(false,"原始密码输入错误！");
        }
    }

    /*用户留言列表*/
    public function actionMessage(){

        $user = Yii::app ()->session ['member'];

        $criteria = new CDbCriteria();
        $criteria->addCondition('user_id='.$user['user_id'],'AND');
        $criteria->order = "createtime desc";
        $count = Message::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;

        $pager->applyLimit($criteria);

        $articles = Message::model()->findAll($criteria);
        $this->data['pages'] = $pager;
        $this->data['list'] = $articles;

        $this->render('message',$this->data);
    }

    public function actionMessage_view(){

        $id = $_GET['id'];
        $message = Message::model()->findByPk($id);
        $this->data['message'] = $message;

        $this->render('message_view',$this->data);
    }

    /*用户反馈列表*/
    public function actionFeedback(){
        $user = Yii::app ()->session ['member'];

        $criteria = new CDbCriteria();
        $criteria->addCondition('user_id='.$user['user_id'],'AND');
        $criteria->order = "createtime desc";
        $count = Feedback::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;

        $pager->applyLimit($criteria);

        $articles = Feedback::model()->findAll($criteria);
        $this->data['pages'] = $pager;
        $this->data['list'] = $articles;

        $this->render('feedback',$this->data);
    }

    public function actionFeedback_view(){

        $id = $_GET['id'];
        $feedback = Feedback::model()->findByPk($id);
        $this->data['feedback'] = $feedback;

        $this->render('feedback_view',$this->data);
    }

    /*用户订单*/
    public function actionOrder(){

        $user = Yii::app ()->session ['member'];

        $orderlist = $this->connection->createCommand("select * from xm_order where user_id = ".$user['user_id'])->queryAll();
        $this->data['orderlist'] = $orderlist;

        $this->render('order',$this->data);
    }

    /*购物车*/
    public function actionShoppingcart(){
        $user = Yii::app ()->session ['member'];

        $shopingcartlist = $this->connection->createCommand("
SELECT sc.num,sc.shopcart_id,a.article_id,a.title,a.price,a.infotype,a.description,img.image imgofpic,prod.image imgofprod FROM xm_shopcart sc
LEFT JOIN xm_article a on sc.article_id = a.article_id
LEFT JOIN xm_article_image img on a.article_id = img.article_id
LEFT JOIN xm_article_product prod on a.article_id = prod.article_id
where sc.user_id = {$user['user_id']}")->queryAll();
        $this->data['shopingcartlist'] = $shopingcartlist;

        $this->render('shoppingcart',$this->data);
    }

    /*订单提交*/
    public function actionCommitorder(){

        //1.生成订单，2.将购物车中生成订单的产品信息删除
        $transaction=$this->connection->beginTransaction();
        try {

            $shopcart_ids = $_POST['shopcart_id'];
            $user = Yii::app ()->session ['member'];

            if(!(sizeof($shopcart_ids)>0)){
                $this->data['message'] = Array('type'=>false,'message'=>'请添加商品！！');
                $this->render('../include/info',$this->data);
                exit();
            }

            $orderid = date("YmdHis");
            $price = 0;
            $numall = 0;

            for($i=0;$i<sizeof($shopcart_ids);$i++){
                $cartid = $shopcart_ids[$i];

                $articleid = $_POST['articleid_'.$cartid];
                $num = $_POST['num_'.$cartid];

                $article = Article::model()->findByPk($articleid);
                $this->connection->createCommand("insert into xm_orderdetails (order_id,article_id,price,num) values
                ('{$orderid}',{$articleid},{$article['price']},{$num} )")->execute();
                $this->connection->createCommand("delete from xm_shopcart where shopcart_id = ".$cartid)->execute();

                $price +=$article['price']*$_POST['num_'.$cartid];
                $numall+=$num;
            }

            //订单进行生成
            $this->connection->createCommand("insert into xm_order (order_id,user_id,price,state,createtime,num)
             values
             ('{$orderid}',{$user['user_id']},{$price},'WAIT_BUYER_PAY',now(),{$numall}) ")->execute();

            $transaction->commit();

            $this->redirect(Yii::app()->request->baseUrl.'/index.php?r=member/showOrder&order_id='.$orderid);
        }catch(Exception $e){
            $transaction->rollBack();
        }

    }

    public function actionShowOrder($order_id){
        $order = $this->connection->createCommand("select * from xm_order where order_id = ".$order_id)->queryRow();
        $this->data['order'] = $order;

        $orderdetails = $this->connection->createCommand("select od.*,art.title from xm_orderdetails od
 LEFT JOIN xm_article art on od.article_id = art.article_id
where od.order_id = ".$order_id)->queryAll();
        $this->data['orderdetails'] = $orderdetails;

        $this->render('showorder',$this->data);
    }

    public function actionPayOrder($order_id){
        $order = $this->connection->createCommand("select * from xm_order where order_id = ".$order_id)->queryRow();
        $this->data['order'] = $order;
        $this->render('payorder',$this->data);
    }


    /* function actionFeedbacklst(){
         $member = Yii::app ()->session ['member'];
         $page = $_REQUEST['page']==null?1:$_REQUEST['page'];
         $pb = new PageBar();
         $start = ($page-1)*$pb->rows;
         $this->data['feedbacklst'] = $this->connection->createCommand("select * from xm_feedback where user_id = {$member['user_id']} limit {$start},{$pb->rows}")->queryAll();
         $pb->page = $page;
         $pb->rowcounts = $this->connection->createCommand("select count(*) from xm_feedback where user_id = {$member['user_id']}")->queryScalar();
         $pb->url = "/index.php/member/feedbacklst";
         $this->data['pb'] = $pb;

         $this->render('feedbacklst',$this->data);
     }

     function actionMessagelst(){

         $member = Yii::app ()->session ['member'];
         $page = $_REQUEST['page']==null?1:$_REQUEST['page'];
         $pb = new PageBar();
         $start = ($page-1)*$pb->rows;
         $this->data['messagelst'] = $this->connection->createCommand("select * from xm_message where user_id = {$member['user_id']} limit {$start},{$pb->rows}")->queryAll();
         $pb->page = $page;
         $pb->rowcounts = $this->connection->createCommand("select count(*) from xm_message where user_id = {$member['user_id']}")->queryScalar();
         $pb->url = "/index.php/member/messagelst";
         $this->data['pb'] = $pb;

         $this->render('messagelst',$this->data);
     }

     function actionMessagelstshow(){
         $mid = $_REQUEST['mid'];
         $this->data['message'] = $this->connection->createCommand("select m.*,u.username replyer from xm_message m left join xm_user u on m.user_id =  u.user_id where message_id = {$mid}")->queryRow();
         $this->render('messagelstshow',$this->data);
     }

     function actionFeedbacklstshow(){
         $fid = $_REQUEST['fid'];
         $this->data['feedback'] = $this->connection->createCommand("select * from xm_feedback f left join xm_feedbacktype ft on f.feedbacktype_id = ft.feedbacktype_id  where feedback_id = {$fid}")->queryRow();
         $this->render('feedbacklstshow',$this->data);
     }

     function actionFeedbacklstedit(){
         $fid = $_REQUEST['fid'];
         $this->data['feedback'] = $this->connection->createCommand("select * from xm_feedback f left join xm_feedbacktype ft on f.feedbacktype_id = ft.feedbacktype_id  where feedback_id = {$fid}")->queryRow();
         $this->render('feedbacklstedit',$this->data);
     }*/

}