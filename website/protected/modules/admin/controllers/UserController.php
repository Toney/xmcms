<?php
class UserController extends AppAdminController {

	public function actionIndex() {

        $criteria = new CDbCriteria();
        $count = User::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);

        $users = User::model()->findAll($criteria);
        $this->render('index',array('pages'=>$pager,'list'=>$users));

	}

    public function actionAdd($id){
        $this->actionShowedit($id);
    }

    public function actionShowedit($id){

        if($id !=0){
            $userinfo = $this->connection->createCommand("select u.*,g.groupname from xm_user u left join xm_group g on u.group_id = g.id  where u.user_id = {$id}")->queryRow();
            $this->data['userinfo'] = $userinfo;
        }

        $groups = $this->connection->createCommand("select * from xm_group")->queryAll();
        $roles = $this->connection->createCommand("select * from xm_role")->queryAll();
        $this->data['groups'] = $groups;
        $this->data['roles'] = $roles;
        $this->data['id'] = $id;

		$this->render ('showedit',$this->data);
	}

    public function actionEdit(){

        $user_id = $_POST['user_id'];

        $sex = $_POST['sex'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $tel = $_POST['tel'];

        $loginname = $_POST['loginname'];
        $username = $_POST['username'];
        $group_id = $_POST['group_id'];
        $isvalid = $_POST['isvalid']==""?0:1;
        $isadmin = $_POST['isadmin']==""?0:1;
        $role_id = $_POST['isadmin']==1?$_POST['role_id']:0;
        $loginpass = $_POST['loginpass'];

        if($user_id == 0){
            $this->connection->createCommand("insert into xm_user (sex,email,phone,tel,loginname,username,group_id,isvalid,createtime,loginpass,isadmin,role_id) values
             ({$sex},'{$email}','{$phone}','{$tel}','{$loginname}','{$username}',{$group_id},{$isvalid},now(),'{$loginpass}',{$isadmin},{$role_id})")->query();
        }else{
            $this->connection->createCommand("update xm_user set sex = {$sex},email='{$email}',phone='{$phone}',tel='{$tel}',group_id={$group_id},isvalid={$isvalid},isadmin={$isadmin},role_id={$role_id} where user_id = {$user_id} ")->query();
        }

        $this->redirect("index.php?r=admin/user/index");
    }

    public function actionDel($id){

        $id = $_GET['id'];

        $this->connection->createCommand("delete from xm_user where user_id = {$id}")->query();

        $this->message(true,null,null);
    }

    public function actionChangepwd(){

        $user_id = $_POST['user_id'];
        $newpass = $_POST['newpass'];

        $newpass = md5($newpass);
        $this->connection->createCommand("update xm_user set loginpass = '{$newpass}' where user_id = {$user_id}")->query();

        $this->message(true,null,null);
    }

}