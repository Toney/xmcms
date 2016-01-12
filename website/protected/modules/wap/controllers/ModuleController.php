<?php

class ModuleController extends AppController
{
	public function actionIndex()
	{
        $parentid = -1;
        if($_GET['parentid']!=null){
            $parentid = $_GET['parentid'];
        }
        $modules = $this->getModulesByParentIdForWap($parentid);
        $this->data['modules'] = $modules;

		$this->render('index',$this->data);
	}
}