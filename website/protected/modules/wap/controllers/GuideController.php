<?php

class GuideController extends AppController
{
	public function actionIndex()
	{

        $module_id = $_GET['module_id'];
        $module = $this->getModuleById($module_id);
        $this->data['module'] = $module;

		$this->render('index',$this->data);
	}
}