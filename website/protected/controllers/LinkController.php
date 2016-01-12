<?php
Yii::import("application.util.PortalCache");
Yii::import("application.util.PageBar");
class LinkController extends PortalController
{

    public function actionIndex(){

        $portalcache = $this->data['portalcache'];

        $id = $_REQUEST['id'];
        $module = $portalcache->getLwithArgs('getmodulebyid',$id,'getmodulebyid_'.$id);

        if($module['url']==""){
            $this->redirect("/");
        }else{
            $this->redirect($module['url']);
        }
    }

}