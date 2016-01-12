<?php
class ImageController extends AppController
{
    public function actionIndex(){
        $id = $_GET['id'];
        $module = Yii::app()->cache->get("module_".$id);
        if($module == false){
            $module = $this->connection->createCommand("select * from xm_module where module_id = ".$id)->queryRow();
            Yii::app()->cache->set("module_".$id, $module);
        }
        $this->data['module'] = $module;

        $topid = $this->getTopIdFromIDEN($module['iden']);

        $modulequeue = Yii::app()->cache->get("modulequeue_".$topid);
        if($modulequeue==false){
            $modulequeue = $this->getQueueModulesById($topid);
            Yii::app()->cache->set("modulequeue_".$topid, $modulequeue);
        }
        $this->data['modulequeue'] = $modulequeue;

        $this->data['cur_moduleid'] =$id;

        $lastimage = Yii::app()->cache->get("lastimage_".$id);
        if($lastimage==false){
            $lastimage = $this->getTopArticleByModule($id,5);
            Yii::app()->cache->set("lastimage_".$topid, $lastimage);
        }
        $this->data['lastimage'] = $lastimage;

        $criteria = new CDbCriteria();
        $criteria->addCondition('infotype="image"','AND');
        $criteria->addCondition('t.lang = "'.$this->lang.'" ','AND');
        $criteria->join = " LEFT JOIN xm_module module ON module.module_id=t.module_id  LEFT JOIN xm_article_image image ON image.article_id=t.module_id ";
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

    public function actionView(){

        $id = $_REQUEST['id'];
        $article = Yii::app()->cache->get("image_".$id);
        if($article==false){
            $article = $this->connection->createCommand("select * from xm_article where article_id = ".$id)->queryRow();
            Yii::app()->cache->set("image_".$id, $article);
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

        $lastarticles = Yii::app()->cache->get("lastarticles_".$article['module_id']);
        if($lastarticles==false){
            $lastarticles = $this->getTopArticleByModule($article['module_id'],5);
            Yii::app()->cache->set("lastarticles_".$topid, $lastarticles);
        }
        $this->data['lastarticles'] = $lastarticles;

        //上一篇图片
        $prevarticle = Yii::app()->cache->get("previmage_".$article['article_id']);
        if($prevarticle==false){
            $prevarticle = $this->getPrevArticle($article['article_id'],$article['module_id']);
            Yii::app()->cache->set("previmage_".$article['article_id'], $prevarticle);
        }
        $this->data['prevarticle'] = $prevarticle;

        //下一篇图片
        $nextarticle = Yii::app()->cache->get("nextarticle".$article['article_id']);
        if($nextarticle==false){
            $nextarticle = $this->getNextArticle($article['article_id'],$article['module_id']);
            Yii::app()->cache->set("nextimage_".$article['article_id'], $nextarticle);
        }
        $this->data['nextarticle'] = $nextarticle;

        Yii::app()->params['TITLE'] = $article['title'];
        Yii::app()->params['APPKEYWORDS'] = $article['tags'].','.$article['title'];
        Yii::app()->params['APPDESCRIPTION'] = csubstr(strip_tags($article['description']),0,200);

        $this->render('view',$this->data);
    }



}