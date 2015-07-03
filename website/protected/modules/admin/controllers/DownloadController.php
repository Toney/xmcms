<?php
class DownloadController extends AppAdminController {

    /*新建*/
    public function actionAdd(){
        $this->actionShowedit();
    }

    /*
     * 由于下载的链接已经集成到了，kindeditor中。所以不需要另外的表进行存储。
     *
     * */
    public function actionShowedit(){
        $id = $_GET['id'];
        $this->data['id'] = $id;
        if($id!=0){
            //编辑
            $download = $this->connection->createCommand(" select * from xm_article where article_id =  ".$id)->queryRow();
            $this->data['download'] = $download;
        }else{
            $this->data['download'] = null;
        }

        $modules = $this->connection->createCommand("select * from xm_module where module = 'download'")->queryAll();
        $this->data['modules'] = $modules;

        $this->render("showedit",$this->data);
    }

    public function actionEdit(){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $seq = $_POST['seq'];
        $tags = $_POST['tags'];
        $recommend = $_POST['recommend'];
        $top = $_POST['top'];
        $moduleid = $_POST['moduleid'];

        $user = Yii::app()->session['user'];

        if($id!=0){
            //编辑
            $this->connection->createCommand("update xm_article set title='{$title}',description='{$description}',seq='{$seq}',tags='{$tags}',recommend='{$recommend}',top='{$top}' where article_id = {$id} ")->execute();
        }else{
            //添加
            $this->connection->createCommand("insert into xm_article (title,description,createtime,seq,sender_id,module_id,lang,tags,infotype,top,recommend)
             values ('{$title}','{$description}','".date("Y-m-d H:i:s")."',{$seq},{$user['user_id']},{$moduleid},'{$this->mgrlang}','{$tags}','download',{$top},{$recommend}) ")->execute();
        }

        $this->redirect("index.php?r=admin/content/index&type=download");
    }

    /**
     * 删除下载
     */
    public function actionDel(){
        $id = $_GET['id'];
        $this->connection->createCommand("delete from xm_article where article_id = ".$id)->execute();
        $this->message(true,null,null);
    }
	
	/*public function actionIndex($current=1) {
		$pb = new PageBar();
		$pb->current = $current;
		$pb->total = $this->connection->createCommand("select count(download_id) from xm_download where lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_1."  ")->queryScalar();
		
		$downloads = $this->connection->createCommand("select d.*,m.category from xm_download d left join xm_module m on d.module_id = m.module_id  where d.lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_2."  order by d.orderby asc limit ".$pb->getStart().",".$pb->rows)->queryAll();

		$this->render ('index',array(			
			'pagebar'=>$pb,
			'downloads'=>$downloads
		));
	}

    public function actionShowedit($id,$current){

        if($id != 0){
            $download = $this->connection->createCommand("select * from xm_download where download_id = {$id}")->queryRow();
            $this->data['download'] = $download;

            $tags = $this->connection->createCommand(" select * from xm_tag where relid = {$id} and type = 'download'")->queryAll();
            $tagstr = "";
            if(sizeof($tags)>0){
                $i=0;
                foreach($tags as $t){
                    if($i==0){
                        $tagstr.="{$t['tag']}";
                    }else{
                        $tagstr.=",{$t['tag']}";
                    }
                    $i++;
                }
            }
            $this->data['tagstr'] = $tagstr;

        }

        $this->data['current'] = $current;
        $this->data['id'] = $id;

        $this->render("showedit",$this->data);
    }

    public function actionEdit(){

        $current = $_POST['current'];
        $download_id = $_POST['download_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $description = addslashes($description);
        $orderby = $_POST['orderby'];
        $module_id = $_POST['module_id'];
        $fileurl = $_POST['fileurl'];
        $filetitle = $_POST['filetitle'];

        $user = Yii::app()->session['user'];

        if($download_id == 0){
            //添加
            $this->connection->createCommand("insert into xm_download (title,description,createtime,orderby,module_id,lang,sender_id,fileurl,filetitle) values ('{$title}','{$description}',now(),'{$orderby}',{$module_id},'".$this->mgrlang."',{$user['user']['user_id']},'{$fileurl}','{$filetitle}') ")->query();
        }else{
            //修改
            $this->connection->createCommand("update xm_download set title = '{$title}',description='{$description}',orderby ={$orderby},module_id={$module_id},lang='".$this->mgrlang."',fileurl='{$fileurl}',filetitle='{$filetitle}' where download_id = {$download_id}")->query();
        }


        $this->redirect("index?current={$current}");
    }

    public function actionDel(){
        $id = $_GET['id'];
        $current = $_GET['current'];

        $this->connection->createCommand("delete from xm_download where download_id = {$id}")->query();

        $this->redirect("index?current={$current}");

    }*/
}