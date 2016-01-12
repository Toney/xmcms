<?php
class DownloadController extends AppController
{
    public function actionIndex(){

        $id = $_GET['id'];
        $module = Yii::app()->cache->get("module_".$id);
        if($module == false){
            $module = $this->connection->createCommand("select * from xm_module where module_id = ".$id)->queryRow();
            Yii::app()->cache->set("module_".$id, $module);
        }
        $this->data['module'] = $module;

        $this->data['cur_moduleid'] =$id;

        $topid = $this->getTopIdFromIDEN($module['iden']);
        $this->topid = $topid;
        $modulequeue = Yii::app()->cache->get("modulequeue_".$topid);
        if($modulequeue==false){
            $modulequeue = $this->getQueueModulesById($topid);
            Yii::app()->cache->set("modulequeue_".$topid, $modulequeue);
        }
        $this->data['modulequeue'] = $modulequeue;

        $lastdownload = Yii::app()->cache->get("lastdownload".$id);
        if($lastdownload==false){
            $lastdownload = $this->getTopArticleByModule($id,5);
            Yii::app()->cache->set("lastdownload_".$id, $lastdownload);
        }
        $this->data['lastdownload'] = $lastdownload;

        //查看对应的下载
        $criteria = new CDbCriteria();
        $criteria->addCondition('infotype="download"','AND');
        $criteria->join = " LEFT JOIN xm_module module ON module.module_id=t.module_id ";
        $criteria->addCondition('module.iden like "%'.$id.'%" ','AND');
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

        $this->render('index',$this->data);

    }

    public function actionView($id){

        $id = $_REQUEST['id'];
        $article = Yii::app()->cache->get("download_".$id);
        if($article==false){
            $article = $this->connection->createCommand("select * from xm_article where article_id = ".$id)->queryRow();
            Yii::app()->cache->set("download_".$id, $article);
        }
        $this->data['article'] = $article;

        $module = Yii::app()->cache->get("module_".$article['module_id']);
        if($module == false){
            $module = $this->connection->createCommand("select * from xm_module where module_id = ".$article['module_id'])->queryRow();
            Yii::app()->cache->set("module_".$article['module_id'], $module);
        }
        $this->data['module'] = $module;

        $topid = $this->getTopIdFromIDEN($module['iden']);
        $modulequeue = Yii::app()->cache->get("modulequeue_".$topid);
        if($modulequeue==false){
            $modulequeue = $this->getQueueModulesById($topid);
            Yii::app()->cache->set("modulequeue_".$topid, $modulequeue);
        }
        $this->data['modulequeue'] = $modulequeue;

        $this->data['cur_moduleid'] = $article['module_id'];

        $lastproducts = Yii::app()->cache->get("lastproducts_".$article['module_id']);
        if($lastproducts==false){
            $lastproducts = $this->getTopArticleByModule($article['module_id'],5);
            Yii::app()->cache->set("lastproducts_".$topid, $lastproducts);
        }
        $this->data['lastproducts'] = $lastproducts;

        //上一个下载
        $prevdownload = Yii::app()->cache->get("prevdownload_".$article['article_id']);
        if($prevdownload==false){
            $prevdownload = $this->getPrevArticle($article['article_id'],$article['module_id']);
            Yii::app()->cache->set("prevdownload_".$article['article_id'], $prevdownload);
        }
        $this->data['prevdownload'] = $prevdownload;

        //下一篇下载
        $nextdownload = Yii::app()->cache->get("nextdownload_".$article['article_id']);
        if($nextdownload==false){
            $nextdownload = $this->getNextArticle($article['article_id'],$article['module_id']);
            Yii::app()->cache->set("nextdownload_".$article['article_id'], $nextdownload);
        }
        $this->data['nextdownload'] = $nextdownload;

        Yii::app()->params['TITLE'] = $article['title'];
        Yii::app()->params['APPKEYWORDS'] = $article['tags'].','.$article['title'];
        Yii::app()->params['APPDESCRIPTION'] = csubstr(strip_tags($article['description']),0,200);

        $this->render('view',$this->data);
    }

}