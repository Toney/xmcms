<?php
class LanguageController extends AppAdminController {

    /*前台WEB网站语言*/
    public function actionIndex() {
        $langs = $this->connection->createCommand("select * from xm_lang where mark !='xmcms' order by id asc")->queryAll();
        $this->render ('index',array(
            'langs'=>$langs
        ));
    }

    /*后台网站语言*/
    public function actionBack(){
        $langs = $this->connection->createCommand("select * from xm_lang where mark ='xmcms' order by id asc")->queryAll();
        $this->render ('back',array(
            'langs'=>$langs
        ));
    }

    /*语言显示编辑*/
    public function actionShowedit(){
        $id = $_GET['id'];
        $lang = $this->connection->createCommand("select * from xm_lang where id = ".$id)->queryRow();
        $this->data['lang'] = $lang;
        $this->render("showedit",$this->data);
    }

    /*语言进行编辑*/
    public function actionEdit(){

        $id = $_POST['id'];
        $useok = $_POST['useok'];
        $isdefault = $_POST['isdefault'];
        $mark = $_POST['mark'];

        $this->connection->createCommand("update xm_lang set useok = {$useok},isdefault={$isdefault} where id = {$id}")->execute();
        if($mark == 'xmcms'){
            $this->redirect("index.php?r=admin/language/back");
        }else{
            $this->redirect("index.php?r=admin/language/index");
        }
    }




}