<?php
class FlashController extends AppAdminController {

    /*FLASH图片列表展示*/
	public function actionIndex() {
		
		$flashs = $this->connection->createCommand("select * from xm_flash where lang = '".$this->mgrlang."'")->queryAll();
		
		$data = Array();
		$data['flashs'] = $flashs;
		
		$this->render ('index',$data);
	}

    /*显示需要编辑的flash页面*/
    function actionShowedit($flash_id){
        $flashimages = $this->connection->createCommand("select * from xm_flashimages where flash_id = {$flash_id} order by seq asc")->queryAll();
        $flash =Flash::model()->findByPk($flash_id);

        $this->data['flashimages'] = $flashimages;
        $this->data['flash_id'] = $flash_id;
        $this->data['flash'] = $flash;

        $this->render ('showedit',$this->data);
    }

    /*图片添加*/
    public function actionAdd(){
        $this->actionEdit();
    }

    /**
     * 编辑FLASHIMAGE
     */
    function actionEdit(){

        $flash_id = $_POST['flash_id'];
        $flashimage_id = $_POST['flashimage_id'];
        $imageurl = $_POST['imageurl'];
        $title = $_POST['title'];
        $imagedesc = $_POST['imagedesc'];
        $seq = $_POST['seq'];
        $link = $_POST['link'];

        if($flashimage_id==""){
            //添加
            $this->connection->createCommand("insert into xm_flashimages (flash_id,imageurl,imagedesc,seq,title,link) values ({$flash_id},'{$imageurl}','{$imagedesc}',{$seq},'{$title}','{$link}') ")->query();
        }else{
            //修改
            $imagedesc = addslashes($imagedesc);
            $this->connection->createCommand("update xm_flashimages set imageurl = '{$imageurl}',title='{$title}',seq={$seq},imagedesc='{$imagedesc}',link='{$link}' where flashimage_id = {$flashimage_id}  ")->query();
        }
        $this->redirect("index.php?r=admin/flash/showedit&flash_id=".$flash_id);
    }

    /**
     *
     * 删除FLASH对应的IMAGE
     *
     * @param $flashimage_id
     * @param $flash_id
     */
    function actionDel($flashimage_id,$flash_id){
        $this->connection->createCommand("delete from xm_flashimages where flashimage_id = {$flashimage_id}")->query();
        $this->redirect("index.php?r=admin/flash/showedit&flash_id=".$flash_id);
    }

    /**
     * @param $id
     * 异步加载获取flashimage内容
     */
    function actionJson($id){
        $obj = $this->connection->createCommand("select * from xm_flashimages where flashimage_id = {$id}")->queryRow();
        $this->message(true,null,$obj);
    }


}