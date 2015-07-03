<?php
class ProductController extends AppAdminController {

    /*新建*/
    public function actionAdd(){
        $this->actionShowedit();
    }

    public function actionShowedit(){
        $id = $_GET['id'];
        $this->data['id'] = $id;
        if($id!=0){
            //编辑
            $product = $this->connection->createCommand(" select * from xm_article article LEFT JOIN xm_article_product img on article.article_id = img.article_id where article.article_id =   ".$id)->queryRow();
            $this->data['product'] = $product;
        }else{
            $this->data['product'] = null;
        }

        $modules = $this->connection->createCommand("select * from xm_module where module = 'product'")->queryAll();
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

        //Product相关附加属性
        $image = $_POST['image'];

        $user = Yii::app()->session['user'];

        if($id!=0){
            //编辑
            $this->connection->createCommand("update xm_article set title='{$title}',description='{$description}',seq='{$seq}',tags='{$tags}',recommend='{$recommend}',top='{$top}' where article_id = {$id} ")->execute();
            $this->connection->createCommand("update xm_article_product set image ='{$image}'  where article_id = {$id} ")->execute();
        }else{
            //添加
            $this->connection->createCommand("insert into xm_article (title,description,createtime,seq,sender_id,module_id,lang,tags,infotype,top,recommend)
             values ('{$title}','{$description}','".date("Y-m-d H:i:s")."',{$seq},{$user['user_id']},{$moduleid},'{$this->mgrlang}','{$tags}','product',{$top},{$recommend}) ")->execute();
            $insertid = Yii::app()->db->getLastInsertID();
            $this->connection->createCommand("insert into xm_article_product (article_id,image) values ({$insertid},'{$image}') ")->execute();
        }

        $this->redirect("index.php?r=admin/content/index&type=product");
    }

    /**
     * 删除产品
     */
    public function actionDel(){
        $id = $_GET['id'];
        $this->connection->createCommand("delete from xm_article where article_id = ".$id)->execute();
        $this->connection->createCommand("delete from xm_article_product where article_id = ".$id)->execute();
        $this->message(true,null,null);
    }
	
	/*public function actionIndex($current=1) {
		
		$pb = new PageBar();
		$pb->current = $current;
		$pb->total = $this->connection->createCommand("select count(product_id) from xm_product where lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_1." ")->queryScalar();
		
		$products = $this->connection->createCommand("select p.*,m.category from xm_product p left join xm_module m on p.module_id = m.module_id  where p.lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_2." order by p.orderby asc limit ".$pb->getStart().",".$pb->rows)->queryAll();

		$this->render ('index',array(			
			'pagebar'=>$pb,
			'products'=>$products
		));
	}

    public function actionShowedit($id,$current){

        if($id !=0){
            $product = $this->connection->createCommand("select * from xm_product where product_id = {$id}")->queryRow();
            $this->data['product'] = $product;

            $tags = $this->connection->createCommand(" select * from xm_tag where relid = {$id} and type = 'product'")->queryAll();
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
        $product_id = $_POST['product_id'];
        $productname = $_POST['productname'];
        $productimage = $_POST['productimage'];
        $productdesc = $_POST['productdesc'];
        $module_id = $_POST['module_id'];
        $orderby = $_POST['orderby'];
        $current = $_POST['current'];
        $tags = $_POST['tags'];

        if($product_id == 0){
            //添加
            $this->connection->createCommand("insert into xm_product (productname,productimage,productdesc,createtime,module_id,lang,orderby) values ('{$productname}','{$productimage}','{$productdesc}',now(),$module_id,'".$this->mgrlang."',{$orderby}) ")->query();
            $product_id =  Yii::app()->db->getLastInsertID();
        }else{
            //修改
            $this->connection->createCommand("update xm_product set productname = '{$productname}',productimage = '{$productimage}',productdesc = '{$productdesc}',module_id={$module_id},orderby='{$orderby}' where product_id = {$product_id}  ")->query();
        }

        if($product_id!=0){
            $this->connection->createCommand("delete from xm_tag where relid = {$product_id} and type = 'product'")->query();
        }

        $tag_array = explode(",", $tags);
        foreach($tag_array as $tag){
            $this->connection->createCommand("insert into xm_tag (tag,type,relid,lang) values ('{$tag}','product',{$product_id},'".$this->mgrlang."')")->query();
        }

        $this->redirect('index?current='.$current);
    }

    public function actionDel($id,$current){

        $this->connection->createCommand("delete from xm_product where product_id = {$id}")->query();
        $this->connection->createCommand("delete from xm_tag where type = 'product' and relid =  {$id}")->query();

        $this->redirect('index?current='.$current);
    }

    public function actionDels(){
        $ids = $_REQUEST['ids'];

        $this->connection->createCommand("delete from xm_product where image_id = {$ids}")->query();
        $this->connection->createCommand("delete from xm_tag where relid in ({$ids} and type = 'product'")->query();

        echo 1;
    }
	*/
}