<?php
Yii::import("application.modules.admin.util.LoginStat");
require_once Yii::app()->basePath.'/plugins/phpmailer/class.phpmailer.php';
require_once Yii::app()->basePath.'/plugins/phpmailer/class.smtp.php';
class SiteController extends AppController
{

    public function actions()
    {
        return array(
            'captcha_memberlogin'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xf4f4f4,
                'maxLength'=>6
            ),
            'captcha_memberregister'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xf4f4f4,
                'maxLength'=>6
            ),
            'captcha_forgetpassword'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xf4f4f4,
                'maxLength'=>6
            ),
            'captcha_resetpassword'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xf4f4f4,
                'maxLength'=>6
            )
        );
    }

	public function actionIndex()
	{
        /*业界动态*/
        $industryInformation = $this->getTopArticleByModule(13,10);
        $this->data['industryInformation'] = $industryInformation;

        /*公司新闻*/
        $lastnews = $this->getTopArticleByModule(12,10);
        $this->data['lastnews'] = $lastnews;

        /*招贤纳士*/
        $employ  = $this->getTopArticleByModule(7,10);
        $this->data['employ'] = $employ;

        /*产品展示*/
        $products = $this->getTopProductByModule(4,2);
        $this->data['products'] = $products;

        /*案例展示*/
        $cases = $this->getTopImageByModule(6,8);
        $this->data['cases'] = $cases;

        $this->home = 1;

        Yii::app()->params['TITLE'] = "首页";

		$this->render('index',$this->data);
	}

    /*忘记密码*/
    public function actionShowforgetpassword(){
        $this->render('showforgetpassword',$this->data);
    }

    /*显示用户登入界面*/
    public function actionShowlogin(){
        $this->render('showlogin',$this->data);
    }

    /*用户登入 Member */
    public function actionLogin(){
        $captchimage = $_POST['captchimage'];
        $loginname = $_POST['loginname'];
        $loginpass = $_POST['loginpass'];
        if($this->createAction('captcha_memberlogin')->validate($captchimage,false)){
            $row = $this->connection->createCommand("select * from xm_user where loginname = '".$loginname."'")->queryRow();
            if($row!=null){
                if($row['loginpass']==md5($loginpass)){
                    //用户登入后，记录用户IP
                    $loginstat = new LoginStat();
                    $loginnum = $row['login_num']+1;
                    $this->connection->createCommand("update xm_user set last_loginip = '".$loginstat->GetIP()."',last_logintime=now(),login_num= ".$loginnum." where user_id = ".$row['user_id'])->query();

                    session_start();
                    $user = $this->connection->createCommand("select * from xm_user where user_id = ".$row['user_id'])->queryRow();
                    Yii::app()->session['member'] = $user;

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

    /*用户登出*/
    public function actionSignout(){
        unset(Yii::app()->session['member']);
        $this->redirect(Yii::app()->request->baseUrl.'/index.php?r=site/showlogin');
    }

    /*显示用户注册界面*/
    public function actionShowregister(){

        $groups = $this->getGroup();
        $this->data['groups'] = $groups;

        $this->render('showregister',$this->data);
    }

    /*用户注册*/
    public function actionRegister(){

        $captcha_memberregister = $_POST['captcha_memberregister'];
        if($this->createAction('captcha_memberregister')->validate($captcha_memberregister,false)){
            $this->createAction('captcha_memberregister')->generateVerifyCode();
            $sex = $_POST['sex'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $tel = $_POST['tel'];
            $loginname = $_POST['loginname'];
            $username = $_POST['username'];
            $group_id = $_POST['group_id'];
            $isvalid = $_POST['isvalid']==""?0:1;
            $isadmin = $_POST['isadmin']==""?0:1;
            $loginpass = $_POST['loginpass'];

            $this->connection->createCommand("insert into xm_user (sex,email,phone,tel,loginname,username,group_id,isvalid,createtime,loginpass,isadmin) values
             ({$sex},'{$email}','{$phone}','{$tel}','{$loginname}','{$username}',{$group_id},{$isvalid},now(),'{$loginpass}',{$isadmin})")->query();

            $this->data['message'] = Array('type'=>'true','message'=>'用户注册成功！<a href="index.php?r=site/showlogin">登入</a>');
            $this->render('../include/info',$this->data);
        }else{
            $this->data['message'] = Array('type'=>'false','message'=>'验证码输入错误！');
            $this->render('../include/info',$this->data);
        }
    }

    /*改变界面语言*/
    public function actionChangelang(){
        Yii::app()->request->cookies['lang'] = new CHttpCookie('lang', $_GET['lang']);;
        echo true;
    }

    public function  actionIp(){
        $loginstat = new LoginStat();
        exit($loginstat->GetIP());
    }

    public function actionError(){
        if($error = Yii::app()->errorHandler->error){
            $this->data['error'] = $error;
            $this->render("error",$this->data);
        }
    }

    /*密码忘记后，发送邮件*/
    public function actionSendemailforforget(){
        $email = $_POST['email'];
        $captcha_forgetpassword = $_POST['captcha_forgetpassword'];
        if($this->createAction('captcha_forgetpassword')->validate($captcha_forgetpassword,false)){
            //正确，邮箱正确，发送密码重置邮件
            //邮箱进行验证
            $c = $this->connection->createCommand("select count(1) from xm_user where email = '".$email."'")->queryScalar();
            if($c>0){

                $code = md5(time());
                $this->connection->createCommand("update xm_user set resetpwdcode = '".$code."',resetpwdcode_time=now() where email = '{$email}'")->execute();

                $basic_config = $this->connection->createCommand("select * from xm_config where lang ='".Yii::app()->language."' and keytype = 'basic' ")->queryAll();
                $basic_array = Array();
                foreach ($basic_config as $b){
                    $basic_array[$b['syskey']] = $b;
                }

                $email_config = $this->connection->createCommand("select * from xm_config where lang ='system' and keytype = 'emailconfig'  ")->queryAll();
                $email_array = Array();
                foreach ($email_config as $e){
                    $email_array[$e['syskey']] = $e;
                }

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = $email_array['emailsmtp']['content'];
                $mail->SMTPAuth = true;
                $mail->Username = $email_array['sendemail']['content'];
                $mail->Password = $email_array['emailpwd']['content'];
                $mail->Port=25;
                $mail->IsHTML(true);

                $mail->setFrom($email_array['sendemail']['content'],$email_array['senduser']['content']);
                $mail->addAddress($email, $email);
                $mail->Subject = '这是来自'.$basic_array['webname']['content'].'密码重置邮件';
                $mail->Body=$this->renderPartial('mail_resetpassword',Array('code'=>$code),true);
                if (!$mail->send()) {
                    $this->message(false,$mail->ErrorInfo,null);
                } else {
                    $this->message(true,"邮件发送成功，请注意查收！！",null);
                }
            }else{
                $this->message(false,"该邮箱不存在！",null);
            }
        }else{
            //验证码错误！！
            $this->message(false,"验证码错误！",null);
        }
    }

    /*显示密码重置页面*/
    public function actionShowresetpassword(){

        $code = $_GET['code'];
        $userinfos = $this->connection->createCommand("select * from xm_user where resetpwdcode  = '{$code}'")->queryRow();

        if(empty($userinfos)){
            $this->data['message'] = Array('type'=>'false','message'=>'该链接已经失效！！');
            $this->render('../include/info',$this->data);
        }else{

            $resettime = $userinfos['resetpwdcode_time'];

            if((time()-strtotime($resettime)) > 60*60*24){
                $this->data['message'] = Array('type'=>'false','message'=>'该链接已经失效，超过预定时间24小时！！');
            }else{
                $this->data['code'] = $code;
                $this->render('showresetpassword',$this->data);
            }
        }
    }

    /*进行密码重置操作*/
    public function actionResetpassword(){
        $loginpass = $_POST['loginpass'];
        $code = $_POST['code'];
        $captcha_forgetpassword = $_POST['captcha_resetpassword'];
        if($this->createAction('captcha_resetpassword')->validate($captcha_forgetpassword,false)){
            $this->connection->createCommand("update xm_user set loginpass = '".md5($loginpass)."' where resetpwdcode = '".$code."'")->execute();
            $this->connection->createCommand("update xm_user set resetpwdcode = null,resetpwdcode_time=null where resetpwdcode = '".$code."'")->execute();
            $this->data['message'] = Array('type'=>'true','message'=>'密码修改成功！');
            $this->render('../include/info',$this->data);
        }else{
            $this->message(false,"验证码错误");
        }
    }

    /*添加入购物车*/
    public function actionAddToShopingcart($article_id){

        $user = Yii::app ()->session ['member'];
        if($user==null){
            $this->message(false,"用户尚未登入，请先登入系统！");
        }else{

            //对应的购物车内物品是否存在？
            $exist = $this->connection->createCommand("select * from xm_shopcart where article_id = {$article_id} and user_id = {$user['user_id']}")->queryRow();
            if($exist==null){
                $this->connection->createCommand("insert into xm_shopcart (user_id,article_id,num) values ({$user['user_id']},{$article_id},1) ")->execute();
            }else{
                $add = $exist['num']+1;
                $this->connection->createCommand("update xm_shopcart set num = {$add} where shopcart_id = ".$exist['shopcart_id'])->execute();
            }
            $this->message(true,"加入购物车成功！");
        }

    }

}