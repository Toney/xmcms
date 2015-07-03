<?php
/**
 * User: ZHUJUN
 * Date: 14-12-30
 * Time: 上午11:04
 */

/**
 * Class ContentController
 *
 * 内容管理
 */
class ContentController extends AppAdminController {

    public function actionIndex() {
        $type = $_GET['type'];
        $this->data['type'] = $type;
        $criteria = new CDbCriteria();
        if(empty($type)){
            $type = 'article';
        }
        $criteria->addCondition('infotype="'.$type.'"','AND');
        $criteria->order = " seq desc,top desc,recommend desc,createtime desc,article_id desc ";
        $count = Article::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);

        $articles = Article::model()->findAll($criteria);
        $this->data['pages'] = $pager;
        $this->data['list'] = $articles;
        $this->render('index',$this->data);
    }

}