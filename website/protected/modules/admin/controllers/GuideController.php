<?php
class GuideController extends AppAdminController {
	
	public function actionIndex() {
		
		$guides = $this->connection->createCommand("select * from xm_module where lang = '".$this->mgrlang."' and module='guide' ")->queryAll();
		
		$data = Array();
		$data['guides'] = $guides;
		
		$this->render ('index',$data);
	}

    public function actionShowedit($id){
        $guide = $this->connection->createCommand("select * from xm_guide where module_id = {$id}")->queryRow();
        $module = $this->connection->createCommand("select * from xm_module where module_id = {$id}")->queryRow();

        if($guide==null){
            $this->connection->createCommand("insert into xm_guide (module_id,description,lang) values ({$id},'','{$this->mgrlang}') ")->query();
        }

        $data = Array();
        $data['guide'] = $guide;
        $data['module']=$module;
        $this->render ('showedit',$data);
    }

    public function actionEdit(){
        $module_id = $_POST['module_id'];
        $modulecontent = $_POST['modulecontent'];
        $this->connection->createCommand("update xm_guide set description = '{$modulecontent}' where module_id = {$module_id}")->query();
        $this->redirect('index');
    }

}
