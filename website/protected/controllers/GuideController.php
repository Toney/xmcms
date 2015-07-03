<?php
class GuideController extends AppController
{
    public function actionIndex()
    {
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

        Yii::app()->params['TITLE'] = $module['category'];
        Yii::app()->params['APPKEYWORDS'] = $module['category'];
        Yii::app()->params['APPDESCRIPTION'] = $module['category'];

        $this->render('index',$this->data);
    }
}