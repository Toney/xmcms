<?php
class OtherController extends AppAdminController {
	
	public function actionIndex() {

        $others = $this->connection->createCommand("select * from xm_other where lang = '".$this->mgrlang."'")->queryAll();
        $others_array = Array();
        foreach ($others as $o){
            $others_array[$o['enname']] = $o;
        }
		
		$this->render ('index',Array('others'=>$others_array));
	}

    public function actionEdit(){
        //index_summary,contact_content
        $index_summary = $_POST['index_summary'];
        $contact_content = $_POST['contact_content'];
        $this->connection->createCommand("update xm_other set description = '{$index_summary}' where enname = 'index_summary' and lang = '".$this->mgrlang."' ")->query();
        $this->connection->createCommand("update xm_other set description = '{$contact_content}' where enname = 'contact_content' and lang = '".$this->mgrlang."' ")->query();
        $this->redirect("index");
    }

}