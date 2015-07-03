<?php
class FriendlinkController extends AppAdminController {

    public function actionIndex() {
        //0,文字链接,2.图片链接
        $friendlinks = $this->connection->createCommand("select * from xm_firendlink order by seq asc")->queryAll();

        $this->render ('index',array(
            'friendlinks'=>$friendlinks
        ));
    }

    public function actionShowedit($id){
        if($id !=0){
            $friendlink =  $this->connection->createCommand("select * from xm_firendlink where friendlink_id = {$id}")->queryRow();
            $this->data['friendlink'] = $friendlink;
        }
        $this->data['id'] = $id;
        $this->render ('showedit',$this->data);
    }

    public function actionEdit(){
        $friendlink_id = $_POST['friendlink_id'];
        $webname = $_POST['webname'];
        $weburl = $_POST['weburl'];
        $logourl = $_POST['logourl'];
        $keyword = $_POST['keyword'];
        $linktype = $_POST['linktype'];
        $seq = $_POST['seq'];
        $isauth = $_POST['isauth'];
        if($isauth==""){
            $isauth = 0;
        }

        if($friendlink_id == 0){
            //添加
            $this->connection->createCommand("insert into xm_firendlink (webname,weburl,logourl,keyword,linktype,seq,isauth,haveread) values
                ('{$webname}','{$weburl}','{$logourl}','{$keyword}',{$linktype},{$seq},{$isauth},1)
             ")->query();
        }else{
            //编辑
            $this->connection->createCommand("update xm_firendlink set haveread = 1,
             webname='{$webname}',weburl='{$weburl}',logourl='{$logourl}',keyword='{$keyword}',linktype={$linktype},seq={$seq},
             isauth ={$isauth}
             where friendlink_id = {$friendlink_id}")->query();
        }
        $this->redirect("index.php?r=admin/friendlink/index");
    }

    public function actionDel($id){

        $this->connection->createCommand("delete from xm_firendlink where friendlink_id = {$id}")->query();

        $this->message(true,null,null);
    }

}