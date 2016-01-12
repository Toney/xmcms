<?php
class SitemapController extends PortalController
{

    public function actionIndex(){
        $this->render('index',$this->data);
    }

}