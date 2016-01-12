<?php

class MessageController extends AppAdminController {
	
	public function actionIndex() {
        $criteria = new CDbCriteria();
        $count = Message::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);

        $messages = Message::model()->findAll($criteria);
        $this->data['pages'] = $pager;
        $this->data['list'] = $messages;

        $this->render('index',$this->data);

	}

    public function actionShowedit($id){
        $this->connection->createCommand("update xm_message set haveread = 1 where message_id = {$id}")->query();
        //编辑
        $message = $this->connection->createCommand("select message.*,u.* from xm_message message LEFT JOIN xm_user u on message.user_id = u.user_id where message_id = {$id}")->queryRow();
        $this->data['message'] = $message;
        $this->data['id'] = $id;
        $this->render("showedit",$this->data);
    }

    public function actionEdit(){
        $message_id = $_POST['message_id'];
        $content = $_POST['content'];
        $reply = $_POST['reply'];
        $user = Yii::app()->session['user'];

        //进行编辑
        $this->connection->createCommand("update xm_message set content = '{$content}',reply='{$reply}',haveread = 1,reply_id={$user['user_id']},createtime=now()  where message_id = {$message_id}")->query();

       $this->redirect('index.php?r=admin/message/index');
    }

}