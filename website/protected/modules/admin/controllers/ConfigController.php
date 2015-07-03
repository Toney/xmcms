<?php
require_once Yii::app()->basePath.'/plugins/phpmailer/class.phpmailer.php';
require_once Yii::app()->basePath.'/plugins/phpmailer/class.smtp.php';
class ConfigController extends AppAdminController {

    /*基本信息编辑页面*/
	public function actionBasic() {
		$basic_config = $this->connection->createCommand("select * from xm_config where lang ='".$this->mgrlang."' and keytype = 'basic' ")->queryAll();
		$basic_array = Array();
		foreach ($basic_config as $b){
			$basic_array[$b['syskey']] = $b;
		}
		
		$email_config = $this->connection->createCommand("select * from xm_config where lang ='system' and keytype = 'emailconfig'  ")->queryAll();
		$email_array = Array();
		foreach ($email_config as $e){
			$email_array[$e['syskey']] = $e;
		}
		$module = $_REQUEST['module'];
		if($module==null){
			$module = 'basic';
		}

        $this->data['basicconfig'] = $basic_array;
        $this->data['emailconfig'] = $email_array;
        $this->data['module'] = $module;

		$this->render ('basic',$this->data);
	}

    /*Email编辑页面*/
    function actionEmail(){

        $email_config = $this->connection->createCommand("select * from xm_config where lang ='system' and keytype = 'emailconfig'  ")->queryAll();
        $email_array = Array();
        foreach ($email_config as $e){
            $email_array[$e['syskey']] = $e;
        }

        $this->data['emailconfig'] = $email_array;

        $this->render ('email',$this->data);
    }

    /*FOOT编辑页面*/
    public function actionFoot() {

        $foot_config = $this->connection->createCommand("select * from xm_config where lang ='".$this->mgrlang."' and keytype = 'foot' ")->queryAll();
        $foot_array = Array();
        foreach ($foot_config as $f){
            $foot_array[$f['syskey']] = $f;
        }

        $this->render ('foot',Array('foot_array'=>$foot_array));
    }

    //基本编辑
    public function actionBasicedit(){
        $this->actionEdit();
    }

    //邮箱编辑
    public function actionEditEmail(){
        $this->actionEdit();
    }

    //编辑页面底部信息
    public function actionEditfoot(){
        $this->actionEdit();
    }

    /*配置编辑操作*/
	public function actionEdit() {
		
		$module = $_POST['module'];
		
		if($module == 'basic'){
            $weblogo = null;
            $image = CUploadedFile::getInstanceByName('image');
            if(is_object($image)&&get_class($image) === 'CUploadedFile'){
                $save_path = $_SERVER['DOCUMENT_ROOT'].'/attached/image/logo/'.date("Ymd");
                $imageurl = "";
                if (!file_exists($save_path)) {
                    mkdir($save_path);
                }
                $imageurl = 'attached/image/logo/'.date("Ymd");

                $filename = md5(time()).'.'.$image->getExtensionName();
                $imageurl.="/".$filename;
                $image->saveAs($save_path.'/'.$filename);
                $weblogo = $imageurl;
            }else{
                $weblogo = $_POST['weblogo'];
            }

			$webname = $_POST['webname'];
			$weburl = $_POST['weburl'];
			$webkeyword = $_POST['webkeyword'];
			$webdesc = $_POST['webdesc'];
            $icp = $_POST['icp'];
            $webtel = $_POST['webtel'];
            $webphone = $_POST['webphone'];
            $webemail = $_POST['webemail'];


			$this->connection->createCommand("update xm_config set content = '".$webname."' where syskey = 'webname' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();
			$this->connection->createCommand("update xm_config set content = '".$weblogo."' where syskey = 'weblogo' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();
			$this->connection->createCommand("update xm_config set content = '".$weburl."' where syskey = 'weburl' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();
			$this->connection->createCommand("update xm_config set content = '".$webkeyword."' where syskey = 'webkeyword' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();
			$this->connection->createCommand("update xm_config set content = '".$webdesc."' where syskey = 'webdesc' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();
            $this->connection->createCommand("update xm_config set content = '".$icp."' where syskey = 'icp' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();
            $this->connection->createCommand("update xm_config set content = '".$webtel."' where syskey = 'webtel' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();
            $this->connection->createCommand("update xm_config set content = '".$webphone."' where syskey = 'webphone' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();
            $this->connection->createCommand("update xm_config set content = '".$webemail."' where syskey = 'webemail' and keytype = 'basic' and lang = '".$this->mgrlang."'")->query();

            $this->data['message'] = "基本信息编辑成功";
            $this->forward("basic",$this->data);
		}else if($module == 'foot'){
            $copyright = $_POST['copyright'];
            $postcode = $_POST['postcode'];
            $contact = $_POST['contact'];
            $othercode = $_POST['othercode'];
            $otherinfo = $_POST['otherinfo'];

            $this->connection->createCommand("update xm_config set content = '{$copyright}' where syskey = 'copyright' and keytype ='foot' and lang = '".$this->mgrlang."'")->query();
            $this->connection->createCommand("update xm_config set content = '{$postcode}' where syskey = 'postcode' and keytype ='foot' and lang = '".$this->mgrlang."'")->query();
            $this->connection->createCommand("update xm_config set content = '{$contact}' where syskey = 'contact' and keytype ='foot' and lang = '".$this->mgrlang."'")->query();
            $this->connection->createCommand("update xm_config set content = '{$othercode}' where syskey = 'othercode' and keytype ='foot' and lang = '".$this->mgrlang."'")->query();
            $this->connection->createCommand("update xm_config set content = '{$otherinfo}' where syskey = 'otherinfo' and keytype ='foot' and lang = '".$this->mgrlang."'")->query();

            $this->forward("foot");
        }else{
			$senduser = $_POST['senduser'];
			$sendemail = $_POST['sendemail'];
			$emailsmtp = $_POST['emailsmtp'];
			$emailpwd = $_POST['emailpwd'];
			
			$this->connection->createCommand("update xm_config set content = '".$senduser."' where syskey = 'senduser' and keytype = 'emailconfig' and lang = 'system'")->query();
			$this->connection->createCommand("update xm_config set content = '".$sendemail."' where syskey = 'sendemail' and keytype = 'emailconfig' and lang = 'system'")->query();
			$this->connection->createCommand("update xm_config set content = '".$emailsmtp."' where syskey = 'emailsmtp' and keytype = 'emailconfig' and lang = 'system'")->query();
			$this->connection->createCommand("update xm_config set content = '".$emailpwd."' where syskey = 'emailpwd' and keytype = 'emailconfig' and lang = 'system'")->query();

            $this->data['message'] = "Email信息编辑成功";
            $this->forward("email",$this->data);
		}
	}

    /*测试邮箱有效性*/
	public function actionTestEmail(){
		$email = $_GET['email'];
		
		$basic_config = $this->connection->createCommand("select * from xm_config where lang ='".$this->mgrlang."' and keytype = 'basic' ")->queryAll();
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
		$mail->setFrom($email_array['sendemail']['content'],$email_array['senduser']['content']);
		$mail->addAddress($email, '邮箱测试账户');
		$mail->Subject = '这是来自'.$basic_array['webname']['content'].'邮箱测试邮件';
		$mail->Body='这是来自'.$basic_array['webname']['content'].'邮箱测试邮件';
		if (!$mail->send()) {
            $this->message(false,null,$mail->ErrorInfo);
		} else {
            $this->message(true,null,null);
		}
		
	}

    /**
     * 支付宝支付接口配置
     */
    public function actionAlipay(){

        $alipays = $this->connection->createCommand("select * from xm_config where keytype = 'alipay'")->queryAll();
        $config = Array();
        foreach ($alipays as $b){
            $config[$b['syskey']] = $b;
        }
        $this->data['config'] = $config;

        $this->render ('alipay',$this->data);
    }

    /*
     * 支付宝接口参数编辑
     * */
    public function actionAlipayEdit(){

        $alipay_id = $_POST['alipay_id'];
        $alipay_key = $_POST['alipay_key'];
        $alipay_account = $_POST['alipay_account'];

        $this->connection->createCommand("update xm_config set content = '".$alipay_id."' where syskey = 'alipay_id' and keytype = 'alipay' and lang = 'system'")->query();
        $this->connection->createCommand("update xm_config set content = '".$alipay_key."' where syskey = 'alipay_key' and keytype = 'alipay' and lang = 'system'")->query();
        $this->connection->createCommand("update xm_config set content = '".$alipay_account."' where syskey = 'alipay_account' and keytype = 'alipay' and lang = 'system'")->query();

        $this->saveConfig();

        $this->redirect("index.php?r=admin/config/alipay");
    }

    public function saveConfig(){
        $configs = $this->connection->createCommand("select * from xm_config where lang = 'system'")->queryAll();
        $cfg_string ='<?php ';
        $cfg_string .="\r\n";
        foreach($configs as $cfg){
            $cfg_string .='$APPCFG[\''.$cfg['syskey'].'\'] = \''.$cfg['content'].'\';';
            $cfg_string .="\r\n";
//            $configs_array[$cfg['syskey']] = $cfg['content'];
        }
        file_put_contents("config/config.php",$cfg_string);
    }


}