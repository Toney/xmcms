<?php
Yii::import("application.modules.manage.util.PageBar");
class AdminController extends AppAdminController {

	public function actionIndex($current=1) {
		$pb = new PageBar();
		$pb->current = $current;
		$pb->total = $this->connection->createCommand("select count(user_id) from xm_user  where isadmin = 1 and loginname !='administrator'")->queryScalar();
		
		$admins = $this->connection->createCommand("select * from xm_user where isadmin = 1 and loginname !='administrator' order by createtime desc limit ".$pb->getStart().",".$pb->rows)->queryAll();
		
		$this->render ('index',array(
				'pagebar'=>$pb,
				'admins'=>$admins
		));
	}


	public function actionConfig() {

        $user = Yii::app()->session['user'];

        $userinfo = $this->connection->createCommand("select * from xm_user where user_id = {$user['user']['user_id']}")->queryRow();
        $this->data['userinfo'] = $userinfo;

		$this->render ('config',$this->data);
	}



    public function actionEdit(){

        $user_id = $_POST['user_id'];
        $current = $_POST['current'];
        $sex = $_POST['sex'];
        $tel = $_POST['tel'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $loginname = $_POST['loginname'];
        $admingroup_id = $_POST['admingroup_id'];
        $loginpass = md5($_POST['loginpass']);
        $isvalid = $_POST['isvalid'];
        if($isvalid == ""){
            $isvalid = 0;
        }

        if($user_id==0){
            //添加
            $this->connection->createCommand("insert into xm_user (sex,tel,phone,email,username,loginname,admingroup_id,loginpass,createtime,isvalid,isadmin) values
            ({$sex},'{$tel}','{$phone}','{$email}','{$username}','{$loginname}',{$admingroup_id},'{$loginpass}',now(),{$isvalid},1)")->query();
        }else{
            //编辑
            $this->connection->createCommand("update xm_user set sex = {$sex},tel='{$tel}',phone='{$phone}',email='{$email}',admingroup_id='{$admingroup_id}',isvalid={$isvalid} where user_id = {$user_id} ")->query();
        }

        if($current!=null){
            $this->redirect("index?current=".$current);
        }else{
            $this->redirect("config");
        }

    }

    public function actionShowedit($id=0,$current) {

        $this->data['id'] = $id;
        $this->data['current'] = $current;

        $admingroups = $this->connection->createCommand("select * from xm_admingroup ")->queryAll();
        $this->data['admingroups'] = $admingroups;

        if($id!=0){
            $userinfo = $this->connection->createCommand("select * from xm_user where user_id = {$id} ")->queryRow();
            $this->data['userinfo'] = $userinfo;
        }

        $this->render ('showedit',$this->data);
    }

    public function actionDel($id=0,$current){

        $this->connection->createCommand("delete from xm_user where user_id = {$id}")->query();

        $this->redirect("index",$current);
    }

    public function actionChangepwd(){

        $user_id = $_POST['user_id'];
        $oldpasswd = $_POST['oldpasswd'];
        $newpass = $_POST['newpass'];

        $msg = Array();

        $user = $this->connection->createCommand("select * from xm_user where user_id = {$user_id}")->queryRow();

        if((md5($oldpasswd) == $user['loginpass']) || ($user['loginpass']=="") ){
            $msg['type'] = true;
            $newpass = md5($newpass);
            $this->connection->createCommand("update xm_user set loginpass = '{$newpass}' where user_id = {$user_id}")->query();
        }else{
            $msg['type'] = false;
            $msg['message']="旧密码错误";
        }

        echo json_encode($msg);
    }

}