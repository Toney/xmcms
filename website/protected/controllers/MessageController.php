<?php
class MessageController extends AppController
{
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
        $modulequeue = Yii::app()->cache->get("modulequeue_".$topid);
        if($modulequeue==false){
            $modulequeue = $this->getQueueModulesById($topid);
            Yii::app()->cache->set("modulequeue_".$topid, $modulequeue);
        }
        $this->data['modulequeue'] = $modulequeue;

        $criteria = new CDbCriteria();
        $criteria->addCondition('module_id='.$id,'AND');
        $criteria->order = "createtime desc";
        $count = Message::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;

        $pager->applyLimit($criteria);

        $articles = Message::model()->findAll($criteria);
        $this->data['pages'] = $pager;
        $this->data['list'] = $articles;

        Yii::app()->params['TITLE'] = $module['category'];
        Yii::app()->params['APPKEYWORDS'] = $module['category'];
        Yii::app()->params['APPDESCRIPTION'] = $module['category'];

        $this->render('index',$this->data);
    }


    /*public function actionIndex(){

        $error = $_REQUEST['error'];
        $this->data['error'] = $error;

        $portalcache = new PortalCache(Yii::app(),$this);
        $pb = new PageBar();

        $id = $_REQUEST['id'];
        $page = $_REQUEST['page']==null?1:$_REQUEST['page'];

        $module = null;
        if($id==null){
            $module = $portalcache->getLwithArgs('getmodule','message','getmodule_message');
            $id = $module['module_id'];
            $this->data['module'] = $module;
        }else{
            $module = $portalcache->getLwithArgs('getmodulebyid',$id,'getmodulebyid_'.$id);
            $this->data['module'] = $module;
        }

        $this->data['menulist'] = $portalcache->getLwithArgs('menulist',$id,'menulist_'.$id);
        $this->data['id'] = $id;

        $args = Array();
        $args['module'] = $module;
        $args['page'] = $page;
        $args['rows'] = $pb->rows;
        $this->data['messages'] = $portalcache->getLwithArgs('getMessages',$args,'message_'.$id.'_'.$page);

        $pb->page = $page;
        $pb->rowcounts = $portalcache->getLwithArgs('getMessageRowcounts',$args,'getMessageRowcounts_'.$id);
        $pb->url = "/index.php/message/index/id/{$id}";
        $this->data['pb'] = $pb;



        $this->render('index',$this->data);

    }

    public function actionMessage(){
        session_start();
        $captcha = $_REQUEST['captcha'];
        if (empty($_SESSION['captcha']) || trim(strtolower($captcha)) != $_SESSION['captcha']) {
            $this->redirect('/index.php/feedback/index?error=3');
        }else{
            //数据录入
            $user = $_POST['user'];
            $description = $_POST['description'];
            $othercontact = $_POST['othercontact'];
            $email = $_POST['email'];
            $module_id = $_POST['module_id'];
            $phone = $_POST['phone'];

            $member = Yii::app ()->session ['member'];
            if($member!=null){
                //当前用户已经登入
                $this->connection->createCommand("insert into xm_message
                (user_id,`user`,description,createtime,lang,module_id,othercontact,email,phone)
                values
                ({$member['user_id']},'{$user}','{$description}',now(),'".Yii::app()->language."',{$module_id},'{$othercontact}','{$email}','${phone}')")->query();
            }else{
                $this->connection->createCommand("insert into xm_feedback
                (`user`,description,createtime,lang,module_id,othercontact,email,phone)
                values
                ('{$user}','{$description}',now(),'".Yii::app()->language."',{$module_id},'{$othercontact}','{$email}','${phone}')")->query();
            }

            $this->redirect('/index.php/message/index/id/'.$module_id.'?error=-1');
        }
    }*/

}