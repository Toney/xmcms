<?php
require Yii::app()->basePath.'/util/CrmFun.php';
class AppAdminController extends CController
{
	public $layout='//layouts/admin';
	public $mgrlang;
    public $bk_lang;
	public $connection;
    public $data = array();
    public $messagedata = array();
    public $user;

    public function init()
    {
        $this->connection = Yii::app()->db;

        /*管理后台内容的语言*/
        if(isset($_GET['mgrlang']) && $_GET['mgrlang'] != "")
        {
            // 设置COOKIE，
            Yii::app()->request->cookies['mgrlang'] = new CHttpCookie('mgrlang', $_GET['mgrlang']);
            $this->mgrlang = $_GET['mgrlang'];
        }
        else if (isset(Yii::app()->request->cookies['mgrlang']) && Yii::app()->request->cookies['mgrlang']->value != "")
        {
            // 根据COOKIE中语言类型来设置语言
            $this->mgrlang = Yii::app()->request->cookies['mgrlang']->value;
        }else{
            Yii::app()->request->cookies['mgrlang'] = new CHttpCookie('mgrlang', 'zh_cn');
            $this->mgrlang = 'zh_cn';
        }

        //后台管理语言
        $APP_MGRLANGS = Yii::app()->cache->get("APP_MGRLANGS");
        if($APP_MGRLANGS==false){
            Yii::app()->cache->set("APP_MGRLANGS", $this->connection->createCommand("select * from xm_lang where mark !='xmcms' ")->queryAll());
        }
        Yii::app()->params['APP_MGRLANGS'] =Yii::app()->cache->get("APP_MGRLANGS");

        if(isset($_GET['bk_lang']) && $_GET['bk_lang'] != "")
        {
            // 通过传递参数更改语言
            Yii::app()->language = $_GET['bk_lang'];
            // 设置COOKIE，
            Yii::app()->request->cookies['bk_lang'] = new CHttpCookie('bk_lang', $_GET['bk_lang']);
            $this->bk_lang = $_GET['bk_lang'];
        }
        else if (isset(Yii::app()->request->cookies['bk_lang']) && Yii::app()->request->cookies['bk_lang']->value != "")
        {
            // 根据COOKIE中语言类型来设置语言
            Yii::app()->language = Yii::app()->request->cookies['bk_lang']->value;
            $this->bk_lang = Yii::app()->request->cookies['bk_lang']->value;
        }else{
            Yii::app()->request->cookies['bk_lang'] = new CHttpCookie('bk_lang', 'xm_zh_cn');
            $this->bk_lang = "xm_zh_cn";
        }

        if(Yii::app()->language!='xm_zh_cn'){
            Yii::app()->sourceLanguage = 'xm_zh_cn';
        }else{
            Yii::app()->sourceLanguage = 'xm_en_us';
        }

        $user = Yii::app ()->session ['user'];
        if(!empty($user)){
            $this->user = $user;
        }

    }

	public function filters() {
		
		$current_uri = Yii::app()->request->requestUri;

        if(strpos($current_uri,'ajax')){
            $this->layout = "//layouts/ajax";
        }

		return array (
				array('application.filters.AuthorityFilter')
		);
	}

    function message($type,$message,$data=null){
        echo json_encode(Array('type'=>$type,'message'=>$message,'data'=>$data));
    }
	
}