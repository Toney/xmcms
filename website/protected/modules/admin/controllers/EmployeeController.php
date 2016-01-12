<?php
Yii::import("application.modules.manage.util.PageBar");
class EmployeeController extends AppAdminController {
	
	public function actionIndex($current=1) {
		
		$pb = new PageBar();
		$pb->current = $current;
		$pb->total = $this->connection->createCommand("select count(employ_id) from xm_employee where lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_1." ")->queryScalar();
		
		$employees = $this->connection->createCommand("select e.*,m.category from xm_employee e left join xm_module m on e.module_id = m.module_id  where e.lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_2."  order by e.orderby asc limit ".$pb->getStart().",".$pb->rows)->queryAll();
		
		$this->render ('index',array(
				'pagebar'=>$pb,
				'employees'=>$employees
		));
		
	}

    public function actionShowedit($id,$current){

        if($id != 0){
            $employee = $this->connection->createCommand("select * from xm_employee where employ_id = {$id}")->queryRow();
            $this->data['employee'] = $employee;

            $tags = $this->connection->createCommand(" select * from xm_tag where relid = {$id} and type = 'employee'")->queryAll();
            $tagstr = "";
            if(sizeof($tags)>0){
                $i=0;
                foreach($tags as $t){
                    if($i==0){
                        $tagstr.="{$t['tag']}";
                    }else{
                        $tagstr.=",{$t['tag']}";
                    }
                    $i++;
                }
            }
            $this->data['tagstr'] = $tagstr;
        }

        $this->data['current'] = $current;
        $this->data['id'] = $id;

        $this->render("showedit",$this->data);
    }

    public function actionEdit(){

        $employ_id = $_POST['employ_id'];
        $current = $_POST['current'];
        $module_id = $_POST['module_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $description = addslashes($description);
        $place = $_POST['place'];
        $pay = $_POST['pay'];
        $employnum = $_POST['employnum'];
        $orderby = $_POST['orderby'];
        $tags = $_POST['tags'];

        //设置标签
        if($employ_id!=0){
            $this->connection->createCommand("delete from xm_tag where relid = {$employ_id} and type = 'employee'")->query();
        }

        if($employ_id==0){
            //添加
            $this->connection->createCommand(" insert into xm_employee (title,place,pay,employnum,createtime,lang,orderby,module_id,description) values (
                '{$title}','{$place}','{$pay}',{$employnum},now(),'".$this->mgrlang."',{$orderby},{$module_id},'{$description}'
            )")->query();
            $employ_id = Yii::app()->db->getLastInsertID();
        }else{
            //修改
            $this->connection->createCommand("update xm_employee set
             title = '{$title}',place = '{$place}',employnum ={$employnum},orderby = {$orderby} ,
             module_id = {$module_id},pay = '{$pay}',description ='{$description}'
             where employ_id = {$employ_id}")->query();
        }

        $tag_array = explode(",", $tags);
        foreach($tag_array as $tag){
            $this->connection->createCommand("insert into xm_tag (tag,type,relid) values ('{$tag}','employee',{$employ_id})")->query();
        }

        $this->redirect("index?current={$current}");


    }

    public function actionDel(){
        $id = $_GET['id'];
        $current = $_GET['current'];

        $this->connection->createCommand("delete from xm_employee where employ_id = {$id} ")->query();
        $this->connection->createCommand("delete from xm_tag where relid = {$id} and type = 'employee'")->query();

        $this->redirect("index?current={$current}");
    }

    public function actionDels(){
        $ids = $_REQUEST['ids'];

        $this->connection->createCommand("delete from xm_employee where employ_id in ({$ids}) ")->query();
        $this->connection->createCommand("delete from xm_tag where relid in ({$ids} and type = 'employee'")->query();

        echo 1;
    }
	
}