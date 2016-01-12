<?php
class FeedbackController extends AppAdminController {
	
	public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->join = " LEFT JOIN xm_module module ON module.module_id=t.module_id ";
        $count = Feedback::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);

        $feedbacks = Feedback::model()->findAll($criteria);
        $this->render('index',array('pages'=>$pager,'list'=>$feedbacks));
    }

    public function actionDel(){
        $id = $_GET['id'];
        $this->connection->createCommand("delete from xm_feedback where feedback_id = {$id}")->execute();
        $this->message(true,null,null);
    }

    public function actionView($id){

        $this->data['id'] = $id;

        $this->connection->createCommand("update xm_feedback set haveread = 1 where feedback_id = {$id}")->query();
        $feedback = Feedback::model()->findByPk($id);
        $this->data['feedback'] = $feedback;

        $this->render ('view',$this->data);
    }


}