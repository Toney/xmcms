<?php
class CacheController extends AppAdminController {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionClearCache(){
        $cache = $_GET['cache'];
        if($cache == 'all'){
            //清除所有缓存
            Yii::app()->cache->flush();
        }
        $this->message(true,null,null);
    }

}