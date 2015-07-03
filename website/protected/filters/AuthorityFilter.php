<?php
Yii::import("application.modules.admin.util.LoginStat");
class AuthorityFilter extends CFilter{
	
	public function preFilter($filterChain){
        return true;
//		$requesturi = Yii::app()->request->url;
        $r = $_REQUEST['r'];
        $requesturi = "/index.php?r=".$r;
        $neednotfilter = Array(
            '/index.php?r=admin/default/index',
            '/index.php?r=admin/default/captcha',
            '/index.php?r=admin/default/login'
        );

		if(
            in_array($requesturi,$neednotfilter)
        ){
			return true;
		}else{
			$user = Yii::app ()->session ['user'];
            if($user['loginname']=='administrator'){
                return true;
            }
            $validate = true;
			if ($user != null) {
                //当管理员处于登入状态的时候，需要判断当前的地址是否在用户的权限中
                if(in_array($requesturi,$user['permissions'])){
                    return true;
                }else{
                    $validate = false;
                }
			}else{
                $member = Yii::app ()->session ['member'];
                if($member['isadmin'] == 1){
                    $loginstat = new LoginStat();
                    $loginnum = $member['login_num']+1;

                    Yii::app()->db->createCommand("update xm_user set last_loginip = '".$loginstat->GetIP()."',last_logintime=now(),login_num= ".$loginnum." where user_id = ".$member['user_id'])->query();

                    session_start();
                    $user = Yii::app()->db->createCommand("select * from xm_user where user_id = ".$member['user_id'])->queryRow();

                    $permissions = Yii::app()->db->createCommand("select permission from xm_role_permission where role_id = ".$member['role_id'])->queryAll();
                    $permissionslist = Array();
                    if(sizeof($permissions)>0){
                        foreach($permissions as $p){
                            $permissionslist[] = $p['permission'];
                        }
                    }
                    $user['permissions'] = $permissionslist;
                    Yii::app()->session['user'] = $user;

                    $deflangs = Yii::app()->db->createCommand("select * from xm_lang where mark !='xmcms'")->queryAll();
                    if(sizeof($deflangs)>0){
                        Yii::app()->session['mgrlang'] = $deflangs[0]['lang'];
                    }else{
                        Yii::app()->session['mgrlang'] = null;
                    }

                    header("Location:".Yii::app()->request->baseUrl."/index.php?r=admin/console/index");
                }else{
                    $validate = false;
                }
			}

            if($validate == false){
                //判断是异步请求还是，同步请求
                if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                    //非异步请求
                    throw new CHttpException(1000,'你没有权限进行操作');
                    exit();
                }else{
                    //异步请求
                    echo json_encode(Array('type'=>false,'message'=>"你没有权限进行操作！"));
                    exit();
                }
            }

		}
	}
	
}
