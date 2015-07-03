<?php
Yii::import("application.modules.manage.util.LoginStat");
class UserController extends PortalController
{

    public function filters() {
        $member = Yii::app ()->session ['member'];
        if($member!=null){
            $this->redirect("/index.php/member/index");
        }
    }

    public function actionIndex(){
        $error = $_GET['error'];
        $this->data['error'] = $error;
        $this->render('index',$this->data);
    }

    public function actionLogin(){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $captcha = $_REQUEST['captcha'];
        session_start();
        if (empty($_SESSION['captcha']) || trim(strtolower($captcha)) != $_SESSION['captcha']) {
            $this->redirect('index?error=3');
        }else{
            $member = $this->connection->createCommand("select u.*,g.* from xm_user u left join xm_group g on u.group_id = g.group_id where u.loginname = '{$name}'")->queryRow();
            if($member==null){
                //不存在用户
                $this->redirect('index?error=1');
            }else{
                if($member['loginpass']==md5($password)){
                    $loginstat = new LoginStat();
                    $loginnum = $member['login_num']+1;

                    $this->connection->createCommand("update xm_user set last_loginip = '".$loginstat->GetIP()."',last_logintime=now(),login_num= ".$loginnum." where user_id = ".$member['user_id'])->query();

                    Yii::app ()->session ['member'] = $member;
                    $this->redirect('../member/index');
                }else{
                    $this->redirect('index?error=2');
                }
            }
        }
    }

}