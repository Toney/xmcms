<?php
class ImageController extends AppAdminController {

    /*新建*/
    public function actionAdd(){
        $this->actionShowedit();
    }

    public function actionShowedit(){
        $id = $_GET['id'];
        $this->data['id'] = $id;
        if($id!=0){
            //编辑
            $image = $this->connection->createCommand(" select * from xm_article article LEFT JOIN xm_article_image img on article.article_id = img.article_id where article.article_id =   ".$id)->queryRow();
            $this->data['image'] = $image;
        }else{
            $this->data['image'] = null;
        }

        $modules = $this->connection->createCommand("select * from xm_module where module = 'image'")->queryAll();
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
        $cansale = $_POST['cansale'];
        $price = $_POST['price'];

        //Image相关附加属性
        $image = $_POST['image'];

        $user = Yii::app()->session['user'];

        if($id!=0){
            //编辑
            $this->connection->createCommand("update xm_article set title='{$title}',description='{$description}',seq='{$seq}',tags='{$tags}',recommend='{$recommend}',top='{$top}',module_id={$moduleid},cansale={$cansale},price = {$price} where article_id = {$id} ")->execute();
            $this->connection->createCommand("update xm_article_image set image ='{$image}'  where article_id = {$id} ")->execute();
        }else{
            //添加
            $this->connection->createCommand("insert into xm_article (title,description,createtime,seq,sender_id,module_id,lang,tags,infotype,top,recommend,cansale,price)
             values ('{$title}','{$description}','".date("Y-m-d H:i:s")."',{$seq},{$user['user_id']},{$moduleid},'{$this->mgrlang}','{$tags}','image',{$top},{$recommend},{$cansale},{$price})) ")->execute();
            $insertid = Yii::app()->db->getLastInsertID();
            $this->connection->createCommand("insert into xm_article_image (article_id,image) values ({$insertid},'{$image}') ")->execute();
        }

        $this->redirect("index.php?r=admin/content/index&type=image");
    }

    /**
     * 删除图片
     */
    public function actionDel(){
        $id = $_GET['id'];
        $this->connection->createCommand("delete from xm_article where article_id = ".$id)->execute();
        $this->connection->createCommand("delete from xm_article_image where article_id = ".$id)->execute();
        $this->message(true,null,null);
    }
	
	/*public function actionIndex($current=1) {
		
		$pb = new PageBar();
		$pb->current = $current;
		$pb->total = $this->connection->createCommand("select count(image_id) from xm_images where lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_1." ")->queryScalar();
		
		$images = $this->connection->createCommand("select img.*,m.category from xm_images img left join xm_module m on img.module_id = m.module_id  where img.lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_2." order by img.orderby asc limit ".$pb->getStart().",".$pb->rows)->queryAll();
		
		$this->render ('index',array(
				'pagebar'=>$pb,
				'images'=>$images
		));
	}

    public function actionShowedit($id,$current){

        if($id !=0){
            $image = $this->connection->createCommand("select * from xm_images where image_id = {$id}")->queryRow();
            $this->data['image'] = $image;

            $tags = $this->connection->createCommand(" select * from xm_tag where relid = {$id} and type = 'image'")->queryAll();
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

        $this->data['id'] = $id;
        $this->data['current'] = $current;

        $this->render("showedit",$this->data);
    }

    public function actionEdit(){
        $image_id = $_POST['image_id'];
        $current = $_POST['current'];
        $module_id = $_POST['module_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $tags = $_POST['tags'];
        $orderby = $_POST['orderby'];

        $user = Yii::app()->session['user'];

        if($image_id!=0){
            $this->connection->createCommand("delete from xm_tag where relid = {$image_id} and type = 'image'")->query();
        }

        if($image_id == 0){
            //添加
            $this->connection->createCommand("insert into xm_images (title,image,description,createtime,sender_id,lang,module_id,orderby) values ('{$title}','{$image}','{$description}',now(),'{$user['user']['user_id']}','".$this->mgrlang."',{$module_id},{$orderby}) ")->query();
            $image_id =  Yii::app()->db->getLastInsertID();
        }else{
            //修改
            $this->connection->createCommand("update xm_images set title = '{$title}',image='{$image}',description='{$description}',module_id='{$module_id}',orderby={$orderby} where image_id = {$image_id}  ")->query();
        }

        $tag_array = explode(",", $tags);
        foreach($tag_array as $tag){
            $this->connection->createCommand("insert into xm_tag (tag,type,relid) values ('{$tag}','image',{$image_id})")->query();
        }

        $this->redirect('index?current='.$current);
    }

    public function actionDel($id,$current){

        $this->connection->createCommand("delete from xm_images where image_id = {$id}")->query();
        $this->connection->createCommand("delete from xm_tag where relid in ({$id} and type = 'image'")->query();

        $this->redirect('index?current='.$current);
    }


    public function actionDels(){
        $ids = $_REQUEST['ids'];

        $this->connection->createCommand("delete from xm_images where image_id in ({$ids})")->query();
        $this->connection->createCommand("delete from xm_tag where relid in ({$ids}) and type = 'image'")->query();

        echo 1;
    }*/

}
