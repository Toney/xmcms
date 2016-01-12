<?php
class OnlineController extends AppAdminController {

    /**
     * 列表载入页面
     */
    public function actionIndex() {
		$onlines = $this->connection->createCommand("select * from xm_online where lang = '".$this->mgrlang."' order by seq asc")->queryAll();
		
		$data = Array();
		$data['onlines'] = $onlines;
		
		$this->render ('index',$data);
	}

    /**
     * @param $id
     *
     * 删除对应的信息
     */
    public function actionDel($id){

        $this->connection->createCommand("delete from xm_online where online_id = {$id}")->query();

        $this->redirect('index.php?r=admin/online/index');
    }

    /**
     * @param $id
     *
     * 在进行编辑的时候返回数据
     */
    function actionJson($id){
        $obj = $this->connection->createCommand("select * from xm_online where online_id = {$id}")->queryRow();
        $this->message(true,null,$obj);
    }

    /**
     * 在线信息进行编辑
     */
    function actionEdit(){

        $online_id = $_POST['online_id'];
        $name = $_POST['name'];
        $seq = $_POST['seq'];
        $qq = $_POST['qq'];
        $taobaowangwang = $_POST['taobaowangwang'];
        $msn = $_POST['msn'];
        $lang = $this->mgrlang;

        if($online_id==""){
            //添加
            $this->connection->createCommand("insert into xm_online (`name`,qq,msn,taobaowangwang,seq,lang) values ('{$name}','{$qq}','{$msn}','{$taobaowangwang}',{$seq},'{$lang}') ")->query();
        }else{
            //修改
            $this->connection->createCommand("update xm_online set `name` = '{$name}',qq='{$qq}',msn='{$msn}',taobaowangwang='{$taobaowangwang}',seq='{$seq}' where online_id = {$online_id} ")->query();
        }
        $this->redirect('index.php?r=admin/online/index');
    }

}