<?php
/**
 * User: ZHUJUN
 * Date: 14-12-30
 * Time: 下午3:04
 */

class RoleController extends AppAdminController {

    public function actionIndex() {
        $roles = $this->connection->createCommand("select * from xm_role")->queryAll();

        $this->render ('index',array(
            'roles'=>$roles
        ));
    }

    public function actionAdd(){
        $this->actionShowedit();
    }

    public function actionShowedit(){
        $id = $_GET['id'];
        if($id!=0){
            //角色
            $role = $this->connection->createCommand("select * from xm_role where id = ".$id)->queryRow();
            $this->data['role'] = $role;
            //权限
            $permissions = $this->connection->createCommand("select permission from xm_role_permission where role_id = ".$id)->queryAll();
            $permissionslist = Array();
            if(sizeof($permissions)>0){
                foreach($permissions as $p){
                    $permissionslist[] = $p['permission'];
                }
            }
            $this->data['permissions'] = $permissionslist;
        }
        $this->data['id'] = $id;

        $this->render("showedit",$this->data);
    }

    public function actionEdit(){
        $id = $_POST['id'];
        $rolename = $_POST['rolename'];
        $permission = $_POST['permission'];

        if($id ==0){
            //添加
            $this->connection->createCommand("insert into xm_role (rolename) values ('{$rolename}') ")->execute();
            $insertid = Yii::app()->db->getLastInsertID();
            $id = $insertid;
        }else{
            //修改
            $this->connection->createCommand("update xm_role set rolename = '{$rolename}' where id = {$id}")->execute();
            $this->connection->createCommand("delete from xm_role_permission where role_id = ".$id)->execute();
        }

        if(sizeof($permission)>0){
            foreach($permission as $p){
                $this->connection->createCommand("insert into xm_role_permission (role_id,permission) values ({$id},'{$p}')  ")->execute();
            }
        }

        $this->redirect("index.php?r=admin/role/index");
    }

    public function actionDel(){
        $id = $_GET['id'];
        $usercount = $this->connection->createCommand("select count(1) from xm_user where role_id = ".$id)->queryScalar();
        if($usercount>0){
            $this->message(false,"该角色下存在对应的用户",null);
        }else{
            $this->connection->createCommand("delete from xm_role where id = ".$id)->execute();
            $this->connection->createCommand("delete from xm_role_permission where role_id = ".$id)->execute();
            $this->message(true,null,null);
        }
    }
} 