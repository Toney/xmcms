<?php
/**
 * User: ZHUJUN
 * Date: 15-1-4
 * Time: 上午8:29
 */

class JobController extends AppAdminController {

    /*新建*/
    public function actionAdd(){
        $this->actionShowedit();
    }

    public function actionShowedit(){
        $id = $_GET['id'];
        $this->data['id'] = $id;
        if($id!=0){
            //编辑
            $job = $this->connection->createCommand(" select * from xm_article article LEFT JOIN xm_article_job job on article.article_id = job.article_id where article.article_id =   ".$id)->queryRow();
            $this->data['job'] = $job;
        }else{
            $this->data['job'] = null;
        }

        $modules = $this->connection->createCommand("select * from xm_module where module = 'job'")->queryAll();
        $this->data['modules'] = $modules;

        $this->render("showedit",$this->data);
    }

    public function actionEdit(){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $seq = $_POST['seq'];
        $tags = $_POST['tags'];
        $recommend = $_POST['recommend'];
        $top = $_POST['top'];
        $moduleid = $_POST['moduleid'];

        //job相关附加属性
        $place = $_POST['place'];
        $pay = $_POST['pay'];
        $employnum = $_POST['employnum'];

        $user = Yii::app()->session['user'];

        if($id!=0){
            //编辑
            $this->connection->createCommand("update xm_article set title='{$title}',description='{$description}',seq='{$seq}',tags='{$tags}',recommend='{$recommend}',top='{$top}' where article_id = {$id} ")->execute();
            $this->connection->createCommand("update xm_article_job set place = '{$place}',pay='{$pay}',employnum={$employnum} where article_id = {$id} ")->execute();
        }else{
            //添加
            $this->connection->createCommand("insert into xm_article (title,description,createtime,seq,sender_id,module_id,lang,tags,infotype,top,recommend)
             values ('{$title}','{$description}','".date("Y-m-d H:i:s")."',{$seq},{$user['user_id']},{$moduleid},'{$this->mgrlang}','{$tags}','job',{$top},{$recommend}) ")->execute();
            $insertid = Yii::app()->db->getLastInsertID();
            $this->connection->createCommand("insert into xm_article_job (article_id,place,pay,employnum) values ({$insertid},'{$place}','{$pay}',{$employnum}) ")->execute();
        }

        $this->redirect("index.php?r=admin/content/index&type=job");
    }

    /**
     * 删除工作
     */
    public function actionDel(){
        $id = $_GET['id'];
        $this->connection->createCommand("delete from xm_article where article_id = ".$id)->execute();
        $this->message(true,null,null);
    }



} 