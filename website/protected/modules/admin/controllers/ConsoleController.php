<?php

class ConsoleController extends AppAdminController {
 
	public function actionIndex() {

        $new_feedback = $this->connection->createCommand("select count(feedback_id) from xm_feedback where haveread = 0 and lang = '".$this->mgrlang."'")->queryScalar();
        $new_message = $this->connection->createCommand("select count(message_id) from xm_message where haveread = 0 ")->queryScalar();
        $new_friendlink = $this->connection->createCommand("select count(friendlink_id) from xm_firendlink where haveread = 0 and lang = '".$this->mgrlang."'")->queryScalar();
        $new_user = $this->connection->createCommand("select count(user_id) from xm_user where isnew = 1")->queryScalar();
        $this->data['new_feedback'] = $new_feedback;
        $this->data['new_message'] = $new_message;
        $this->data['new_friendlink'] = $new_friendlink;
        $this->data['new_user'] = $new_user;

        /*
        页面登入后系统状态信息，根据当前页面的语言进行查询
        文章： 产品：
        下载： 	图片：
        招聘： 	单页：
        片段： 	反馈：
        友情链接： 	FLASH：
        */
        $count_article = $this->connection->createCommand("select count(1) from xm_article where infotype = 'article' and lang = '".$this->mgrlang."'")->queryScalar();
        $this->data['count_article'] = $count_article;
        $count_product = $this->connection->createCommand("select count(1) from xm_article where infotype = 'product' and lang = '".$this->mgrlang."'")->queryScalar();
        $this->data['count_product'] = $count_product;
        $count_download  = $this->connection->createCommand("select count(1) from xm_article where infotype = 'download' and lang = '".$this->mgrlang."'")->queryScalar();
        $this->data['count_download'] = $count_download;
        $count_image = $this->connection->createCommand("select count(1) from xm_article where infotype = 'image' and lang = '".$this->mgrlang."'")->queryScalar();
        $this->data['count_image'] = $count_image;
        $count_job = $this->connection->createCommand("select count(1) from xm_article where infotype = 'job' and lang = '".$this->mgrlang."'")->queryScalar();
        $this->data['count_job'] = $count_job;
        $count_guide = $this->connection->createCommand("select count(1) from xm_article where infotype = 'guide' and lang = '".$this->mgrlang."'")->queryScalar();
        $this->data['count_guide'] = $count_guide;
        $count_fragment = $this->connection->createCommand("select count(1) from xm_fragment where lang = '".$this->mgrlang."'")->queryScalar();
        $this->data['count_fragment'] = $count_fragment;
        $count_feedback = $this->connection->createCommand("select count(1) from xm_feedback ")->queryScalar();
        $this->data['count_feedback'] = $count_feedback;
        $count_friendlink = $this->connection->createCommand("select count(1) from xm_firendlink where lang = '".$this->mgrlang."' ")->queryScalar();
        $this->data['count_friendlink'] = $count_friendlink;
        $count_flash = $this->connection->createCommand("select count(1) from xm_flash where lang = '".$this->mgrlang."' ")->queryScalar();
        $this->data['count_flash'] = $count_flash;

		$this->render ('index',$this->data);
	}

    function actionShowmenu($key){
        $this->layout='//../../../protected/modules/manage/views/layouts/content';
        $this->data['key']=$key;
        $this->render("showmenu",$this->data);
    }

	public function actionMgrlang($lang){

        Yii::app()->request->cookies['mgrlang'] = new CHttpCookie('mgrlang',$lang);

		$this->message(true,null,null);
	}
	
}