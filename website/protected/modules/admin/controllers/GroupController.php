<?php
class GroupController extends AppAdminController {

	public function actionIndex() {
		$groups = $this->connection->createCommand("select * from xm_group where lang = '".$this->mgrlang."'")->queryAll();
		
		$this->render ('index',array(
				'groups'=>$groups
		));
	}

    public function actionAdd($id){
        $this->actionShowedit($id);
    }

    public function actionShowedit($id){

        if($id!=0){
            $group = $this->connection->createCommand("select * from xm_group where id = {$id}")->queryRow();
            $this->data['group'] = $group;
        }

        $this->data['id'] = $id;
        $this->render("showedit",$this->data);
    }

    public function actionDel($id){

        $this->connection->createCommand("delete from xm_group where id = {$id}")->query();

        $this->message(true,null,null);
    }

    public function actionEdit(){
        $group_id = $_POST['id'];
        $groupname = $_POST['groupname'];

        if($group_id == 0 ){
            //添加
            $this->connection->createCommand("insert into xm_group (groupname,lang) values ('{$groupname}','".$this->mgrlang."')")->query();
        }else{
            $this->connection->createCommand("update xm_group set groupname = '{$groupname}' where id = {$group_id}")->query();
        }

        $this->redirect("index.php?r=admin/group/index");
    }

}