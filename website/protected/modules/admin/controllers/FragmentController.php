<?php
class FragmentController extends AppAdminController {

    /*片段列表页面载入*/
    public function actionIndex() {

        $fragmengs =  $this->connection->createCommand("select * from xm_fragment where lang = '".$this->mgrlang."'")->queryAll();
        $this->data['fragments'] = $fragmengs;

        $this->render ('index',$this->data);
    }

    /*片段删除*/
    public function actionDel($id){

        $this->connection->createCommand("delete from xm_fragment where id = {$id}")->query();

        $this->message(true,null,null);
    }

    /*public function actionDels(){

        $ids = $_REQUEST['ids'];

        $this->connection->createCommand("delete from xm_fragment where id in ({$ids})")->query();

        echo 1;
    }*/
    public function actionAdd($id){
        $this->data['id'] = $id;
        $this->render ('showedit',$this->data);
    }

    /*显示片段编辑*/
    public function actionShowedit($id){

        $this->data['fragment'] = $this->connection->createCommand("select * from xm_fragment where id = {$id}")->queryRow();
        $this->data['id'] = $id;

        $this->render ('showedit',$this->data);
    }

    /*显示片段处理*/
    public function actionEdit(){

        $id = $_REQUEST['id'];
        $key = $_REQUEST['key'];
        $content = $_REQUEST['content'];
        $title = $_REQUEST['title'];

        $this->data['id'] = $id;
        if($id==0){
            //添加
            $this->connection->createCommand(" insert into xm_fragment (`key`,content,title,lang) values ('{$key}','{$content}','{$title}','".$this->mgrlang."') ")->query();
        }else{
            $this->connection->createCommand(" update xm_fragment set `key`='{$key}',content='{$content}',title='{$title}' where id = {$id} ")->query();
        }

        $this->redirect("index.php?r=admin/fragment/index");
    }


}
