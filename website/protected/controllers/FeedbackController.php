<?php
class FeedbackController extends AppController
{

    public function actions()
    {
        return array(
            'captcha_feedback'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xf4f4f4,
                'maxLength'=>6
            ),
        );
    }


    public function actionIndex(){

        $id = $_REQUEST['id'];
        $this->data['cur_moduleid'] = $id;

        $module = Yii::app()->cache->get("module_".$id);
        if($module == false){
            $module = $this->connection->createCommand("select * from xm_module where module_id = ".$id)->queryRow();
            Yii::app()->cache->set("module_".$id, $module);
        }
        $this->data['module'] = $module;

        /*右侧导航栏*/
        $topid = $this->getTopIdFromIDEN($module['iden']);
        $this->topid = $topid;
        $modulequeue = Yii::app()->cache->get("modulequeue_".$topid);
        if($modulequeue==false){
            $modulequeue = $this->getQueueModulesById($topid);
            Yii::app()->cache->set("modulequeue_".$topid, $modulequeue);
        }
        $this->data['modulequeue'] = $modulequeue;

        $this->render('index',$this->data);

    }

    public function actionFeedback(){

        $captcha_feedback = $_POST['captcha_feedback'];

        if($this->createAction('captcha_feedback')->validate($captcha_feedback,false)){
            $module_id = $_POST['module_id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $phone = $_POST['phone'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $content = $_POST['content'];
            $user_id =empty( $_POST['user_id'])?"0": $_POST['user_id'];
            $content = addslashes($content);

            $this->connection->createCommand("insert into xm_feedback (module_id,name,sex,phone,content,tel,email,createtime,user_id,lang)
             values
             ({$module_id},'{$name}',{$sex},'{$phone}','{$content}','{$tel}','{$email}',now(),{$user_id},'{$this->lang}')")->execute();

            $this->data['message'] = Array('type'=>'true','message'=>'反馈成功！');
            $this->render('../include/info',$this->data);

        }else{

            $this->data['message'] = Array('type'=>'false','message'=>'验证码输入错误！');
            $this->render('../include/info',$this->data);

        }
    }

    /*public function actionFeedback(){
        session_start();
        $captcha = $_REQUEST['captcha'];
        if (empty($_SESSION['captcha']) || trim(strtolower($captcha)) != $_SESSION['captcha']) {
            $this->redirect('/index.php/feedback/index?error=3');
        }else{
            //数据录入
            $user = $_POST['user'];
            $title = $_POST['title'];
            $descrption = $_POST['descrption'];
            $feedbacktype_id = $_POST['feedbacktype_id'];
            $email = $_POST['email'];
            $module_id = $_POST['module_id'];

            $member = Yii::app ()->session ['member'];
            if($member!=null){
                //当前用户已经登入
                $this->connection->createCommand("insert into xm_feedback
                (user_id,title,`user`,description,createtime,lang,module_id,feedbacktype_id,email)
                values
                ({$member['user_id']},'{$title}','{$user}','{$descrption}',now(),'".Yii::app()->language."',{$module_id},{$feedbacktype_id},'{$email}')")->query();
            }else{
                $this->connection->createCommand("insert into xm_feedback
                (title,`user`,description,createtime,lang,module_id,feedbacktype_id,email)
                values
                ('{$title}','{$user}','{$descrption}',now(),'".Yii::app()->language."',{$module_id},{$feedbacktype_id},'{$email}')")->query();
            }

            $this->redirect('/index.php/feedback/index/id/'.$module_id.'?error=-1');
        }
    }*/


}