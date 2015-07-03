<?php
class ArticleController extends AppAdminController {

    /*新建*/
    public function actionAdd(){
        $this->actionShowedit();
    }

    public function actionShowedit(){
        $id = $_GET['id'];
        $this->data['id'] = $id;
        if($id!=0){
            //编辑
            $article = $this->connection->createCommand(" select * from xm_article where article_id =  ".$id)->queryRow();
            $this->data['article'] = $article;
        }else{
            $this->data['article'] = null;
        }

        $modules = $this->connection->createCommand("select * from xm_module where module = 'article'")->queryAll();
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
            $this->connection->createCommand("update xm_article set title='{$title}',description='{$description}',seq='{$seq}',tags='{$tags}',recommend='{$recommend}',top='{$top}',module_id='{$moduleid}' where article_id = {$id} ")->execute();
        }else{
            //添加
            $this->connection->createCommand("insert into xm_article (title,description,createtime,seq,sender_id,module_id,lang,tags,infotype,top,recommend)
             values ('{$title}','{$description}','".date("Y-m-d H:i:s")."',{$seq},{$user['user_id']},{$moduleid},'{$this->mgrlang}','{$tags}','article',{$top},{$recommend}) ")->execute();
        }

        $this->redirect("index.php?r=admin/content/index&type=article");
    }

    /**
     * 删除文章
     */
    public function actionDel(){
        $id = $_GET['id'];
        $this->connection->createCommand("delete from xm_article where article_id = ".$id)->execute();
        $this->message(true,null,null);
    }
	
	/*public function actionIndex($current=1) {
		
		$pb = new PageBar();
		$pb->current = $current;
		$pb->total = $this->connection->createCommand("select count(article_id) from xm_article where lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_1." ")->queryScalar();
		
		$articles = $this->connection->createCommand("select a.*,m.category from xm_article a left join xm_module m on a.module_id = m.module_id  where a.lang = '".$this->mgrlang."' ".$this->self." ".$this->inmodule_2." order by a.orderby asc limit ".$pb->getStart().",".$pb->rows)->queryAll();

		$this->render ('index',array(			
			'pagebar'=>$pb,
			'articles'=>$articles
		));
	}

    public function actionShowedit($id,$current){

        if($id == 0){
            $this->render("showedit",Array('current'=>$current,'id'=>$id));
        }else{
            $article = $this->connection->createCommand(" select a.*,m.category from xm_article a left join xm_module m on a.module_id = m.module_id where a.article_id = {$id} ")->queryRow();
            $tags = $this->connection->createCommand(" select * from xm_tag where relid = {$id} and type = 'article'")->queryAll();
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
            $this->render("showedit",Array('article'=>$article,'current'=>$current,'id'=>$id,'tagstr'=>$tagstr));
        }
    }

    public function actionEdit(){
        $article_id = $_POST['article_id'];
        $current = $_POST['current'];
        $description = $_POST['description'];
        $tags = $_POST['tags'];
        $title = $_POST['title'];
        $orderby = $_POST['orderby'];
        $module_id = $_POST['module_id'];

        $user = Yii::app()->session['user'];

        //设置标签
        if($article_id!=0){
            $this->connection->createCommand("delete from xm_tag where relid = {$article_id} and type = 'article'")->query();
        }

        if($article_id==0){
            //添加
            $this->connection->createCommand(" insert into xm_article (title,description,createtime,orderby,sender_id,module_id) values ('{$title}','{$description}',now(),{$orderby},{$user['user']['user_id']},{$module_id})")->query();
            $article_id = Yii::app()->db->getLastInsertID();
        }else{
            //修改
            $this->connection->createCommand("update xm_article set title = '{$title}',description = '{$description}',orderby={$orderby},module_id = {$module_id} where article_id = {$article_id}")->query();
        }

        $tag_array = explode(",", $tags);
        foreach($tag_array as $tag){
            $this->connection->createCommand("insert into xm_tag (tag,type,relid,lang) values ('{$tag}','article',{$article_id},'".$this->mgrlang."')")->query();
        }

        $this->redirect("index?current={$current}");
    }

    public function actionDel(){
        $id = $_GET['id'];
        $current = $_GET['current'];

        $this->connection->createCommand("delete from xm_article where article_id = {$id} ")->query();
        $this->connection->createCommand("delete from xm_tag where relid = {$id} and type = 'article'")->query();

        $this->redirect("index?current={$current}");
    }

    public function actionDels(){
        $ids = $_REQUEST['ids'];

        $this->connection->createCommand("delete from xm_article where image_id = {$ids}")->query();
        $this->connection->createCommand("delete from xm_tag where relid in ({$ids} and type = 'article'")->query();

        echo 1;
    }*/

}