<?php
Yii::import("application.modules.admin.util.LoginStat");
class DefaultController extends AppAdminController
{

    public function actions()
    {
        return array(
            'captcha_login'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xf4f4f4,
                'maxLength'=>6
            ),
        );
    }

    public function actionIndex()
	{
		$user = Yii::app ()->session ['user'];
		if ($user != null) {
			$this->redirect('index.php?r=admin/console/index');
			exit();
		}
        $this->layout = "none";

        $backlangs = $this->connection->createCommand("select * from xm_lang where mark = 'xmcms'")->queryAll();
        $this->data['backlangs'] = $backlangs;

        $this->render('index',$this->data);
	}

    public function actionLogin(){
        $loginname = $_REQUEST['loginname'];
        $loginpass = $_REQUEST['loginpass'];
        $logincaptcha = $_REQUEST['logincaptcha'];

        if($this->createAction('captcha_login')->validate($logincaptcha,false)){
            $row = $this->connection->createCommand("select * from xm_user where loginname = '".$loginname."' and isadmin = 1 ")->queryRow();
            if($row!=null){
                if($row['loginpass']==md5($loginpass)){
                    $loginstat = new LoginStat();
                    $loginnum = $row['login_num']+1;

                    $this->connection->createCommand("update xm_user set last_loginip = '".$loginstat->GetIP()."',last_logintime=now(),login_num= ".$loginnum." where user_id = ".$row['user_id'])->query();

                    session_start();
                    $user = $this->connection->createCommand("select * from xm_user where user_id = ".$row['user_id'])->queryRow();

                    $permissions = Yii::app()->db->createCommand("select permission from xm_role_permission where role_id = ".$row['user_id'])->queryAll();
                    $permissionslist = Array();
                    if(sizeof($permissions)>0){
                        foreach($permissions as $p){
                            $permissionslist[] = $p['permission'];
                        }
                    }
                    $user['permissions'] = $permissionslist;

                    $deflangs = Yii::app()->db->createCommand("select * from xm_lang where mark !='xmcms' and isdefault = 1")->queryAll();
                    if(sizeof($deflangs)>0){
                        Yii::app()->session['mgrlang'] = $deflangs[0]['lang'];
                    }else{
                        Yii::app()->session['mgrlang'] = null;
                    }

                    Yii::app()->session['user'] = $user;
                    /*用于CKFINDER验证*/
                    $_SESSION['IsAuthorized'] = 1;

                    $this->message(true,null,null);
                }else{
                    $this->message(false,'密码输入有误',null);
                }
            }else{
                $this->message(false,'用户名不存在',null);
            }
        }else{
            $this->message(false,'验证码不正确',null);
        }
    }

    /*修改后台登入的语言*/
    public function actionChangebklang(){
        $this->message(true,null,null);
    }
	
	public function actionLogout()
	{
		unset(Yii::app()->session['user']);
		$this->redirect('index.php?r=admin/default/index');
	}
}