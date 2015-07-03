<?php

class JobController extends AppController
{

    public function actionIndex()
    {
        $id = $_REQUEST['id'];
        $this->data['cur_moduleid'] = $id;

        $module = Yii::app()->cache->get("module_" . $id);
        if ($module == false) {
            $module = $this->connection->createCommand("select * from xm_module where module_id = " . $id)->queryRow();
            Yii::app()->cache->set("module_" . $id, $module);
        }
        $this->data['module'] = $module;

        /*右侧导航栏*/
        $topid = $this->getTopIdFromIDEN($module['iden']);
        $this->topid = $topid;
        $modulequeue = Yii::app()->cache->get("modulequeue_" . $topid);
        if ($modulequeue == false) {
            $modulequeue = $this->getQueueModulesById($topid);
            Yii::app()->cache->set("modulequeue_" . $topid, $modulequeue);
        }
        $this->data['modulequeue'] = $modulequeue;

        $lastarticles = Yii::app()->cache->get("lastarticles_" . $id);
        if ($lastarticles == false) {
            $lastarticles = $this->getTopArticleByModule($id, 5);
            Yii::app()->cache->set("lastarticles_" . $id, $lastarticles);
        }
        $this->data['lastarticles'] = $lastarticles;

        //查看对应的工作
        $criteria = new CDbCriteria();
        $criteria->addCondition('infotype="job"', 'AND');
        $criteria->join = " LEFT JOIN xm_module module ON module.module_id=t.module_id  LEFT JOIN xm_article_job job ON job.article_id=t.module_id ";
        $criteria->addCondition('module.iden like "%' . $id . '%" ', 'AND');
        $criteria->order = "article_id desc ,seq desc,top desc,recommend desc,createtime desc";
        $count = Article::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;

        $pager->applyLimit($criteria);

        $articles = Article::model()->findAll($criteria);
        $this->data['pages'] = $pager;
        $this->data['list'] = $articles;

        Yii::app()->params['TITLE'] = $module['category'];
        Yii::app()->params['APPKEYWORDS'] = $module['category'];
        Yii::app()->params['APPDESCRIPTION'] = $module['category'];

        $this->render('index', $this->data);
    }

    /* public function actionIndex(){

         $portalcache = new PortalCache(Yii::app(),$this);
         $pb = new PageBar();

         $id = $_REQUEST['id'];
         $page = $_REQUEST['page']==null?1:$_REQUEST['page'];

         $module = null;
         if($id==null){
             $module = $portalcache->getLwithArgs('getmodule','employee','getmodule_employee');
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
         $this->data['employees'] = $portalcache->getLwithArgs('getEmployees',$args,'employee_'.$id.'_'.$page);

         $pb->page = $page;
         $pb->rowcounts = $portalcache->getLwithArgs('getEmployeeRowcounts',$args,'getEmployeeRowcounts_'.$id);
         $pb->url = "/index.php/employee/index/id/{$id}";
         $this->data['pb'] = $pb;

         $this->render('index',$this->data);

     }

     public function actionView($id){
         $portalcache = new PortalCache(Yii::app(),$this);
         $employee = $portalcache->getLwithArgs('getemployeebyid',$id,'getemployee_'.$id);

         $this->data['menulist'] = $portalcache->getLwithArgs('menulist',$employee['module_id'],'menulist_'.$employee['module_id']);
         $this->data['employee'] = $employee;

         $this->render('view',$this->data);
     }*/

    public function actionView()
    {

        $id = $_REQUEST['id'];
        $article = Yii::app()->cache->get("job_" . $id);
        if ($article == false) {
            $article = $this->connection->createCommand("select * from xm_article where article_id = " . $id)->queryRow();
            Yii::app()->cache->set("job_" . $id, $article);
        }
        $this->data['article'] = $article;

        $module = Yii::app()->cache->get("module_" . $article['module_id']);
        if ($module == false) {
            $module = $this->connection->createCommand("select * from xm_module where module_id = " . $article['module_id'])->queryRow();
            Yii::app()->cache->set("module_" . $article['module_id'], $module);
        }
        $this->data['module'] = $module;

        $topid = $this->getTopIdFromIDEN($module['iden']);
        $modulequeue = Yii::app()->cache->get("modulequeue_" . $topid);
        if ($modulequeue == false) {
            $modulequeue = $this->getQueueModulesById($topid);
            Yii::app()->cache->set("modulequeue_" . $topid, $modulequeue);
        }
        $this->data['modulequeue'] = $modulequeue;

        $this->data['cur_moduleid'] = $article['module_id'];

        $lastarticles = Yii::app()->cache->get("lastarticles_" . $article['module_id']);
        if ($lastarticles == false) {
            $lastarticles = $this->getTopArticleByModule($article['module_id'], 5);
            Yii::app()->cache->set("lastarticles_" . $topid, $lastarticles);
        }
        $this->data['lastarticles'] = $lastarticles;

        //上一个JOB
        $prevarticle = Yii::app()->cache->get("prevarticle_" . $article['job_id']);
        if ($prevarticle == false) {
            $prevarticle = $this->getPrevArticle($article['article_id'], $article['module_id']);
            Yii::app()->cache->set("prevarticle_" . $article['article_id'], $prevarticle);
        }
        $this->data['prevarticle'] = $prevarticle;

        //下一个JOB
        $nextarticle = Yii::app()->cache->get("nextarticle_" . $article['job_id']);
        if ($nextarticle == false) {
            $nextarticle = $this->getNextArticle($article['article_id'], $article['module_id']);
            Yii::app()->cache->set("nextarticle_" . $article['article_id'], $nextarticle);
        }
        $this->data['nextarticle'] = $nextarticle;

        Yii::app()->params['TITLE'] = $article['title'];
        Yii::app()->params['APPKEYWORDS'] = $article['tags'].','.$article['title'];
        Yii::app()->params['APPDESCRIPTION'] = csubstr(strip_tags($article['description']),0,200);


        $this->render('view', $this->data);
    }

}