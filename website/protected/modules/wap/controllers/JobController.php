<?php

class JobController extends AppController
{
	public function actionIndex()
	{
        $id = $_GET['module_id'];

        $modules = $this->getModulesByParentIdForWap($_GET['module_id']);
        $this->data['modules'] = $modules;

        $criteria = new CDbCriteria();
        $criteria->addCondition('infotype="job"','AND');
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

        $module = $this->getModuleById($_GET['module_id']);
        $this->data['module'] = $module;

        $this->render('index',$this->data);
	}


    public function actionView(){
        $article_id = $_GET['article_id'];
        $article = Article::model()->findByPk($article_id);
        $this->data['article'] = $article;
        $this->render('view',$this->data);
    }
}