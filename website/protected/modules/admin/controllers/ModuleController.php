<?php
class ModuleController extends AppAdminController {

    /**
     * 模块管理初始化页面，先查询顶级的模块，再进行异步加载
     */
    public function actionIndex() {

        $modules = $this->connection->createCommand("SELECT module.url,module.seq,module.module_id,module.category,module.ishid,module.module,(select count(1) from xm_module where parentid = module.module_id) childcounts FROM xm_module module WHERE LANG = '".$this->mgrlang."' and parentid = -1 ORDER BY seq desc")->queryAll();
        $this->data['modules'] = $modules;

        $this->render ('index',$this->data);
	}

    /**
     * 异步加载对应的子的模块信息
     */
    public function actionAjax_LoadChilds(){
        $id = $_GET['id'];

        $childs = $this->connection->createCommand("SELECT module.url,module.seq,module.module_id,module.parentid,module.category,module.ishid,module.module,(select count(1) from xm_module where parentid = module.module_id) childcounts  FROM xm_module module where  LANG = '".$this->mgrlang."' and parentid = ".$id."  ORDER BY module.seq desc ")->queryAll();
        $newchilds = Array();
        foreach($childs as $c){
            if($c['childcounts']>0){
                //如果大于0的话，就是存在子模块
                $c['childs'] = $this->connection->createCommand("SELECT module.url,module.seq,module.module_id,module.parentid,module.category,module.ishid,module.module,(select count(1) from xm_module where parentid = module.module_id) childcounts  FROM xm_module module where  LANG = '".$this->mgrlang."' and parentid = ".$c['module_id']."  ORDER BY module.seq desc ")->queryAll();
            }
            $newchilds[] = $c;
        }
        $this->data['childs'] = $newchilds;

        $this->messagedata['id'] = $id;
        $this->messagedata['html'] = $this->render ('ajax_LoadChilds',$this->data,true);
        $this->message(true,null,$this->messagedata);
    }

    /**
     * @param $module
     * @return string
     *
     * 根据英文返回对应中文
     */
    public function getModuleName($module){
        switch($module){
            case 'guide':
                $module = '内容';
                break;
            case 'feedback':
                $module = '反馈';
                break;
            case 'article':
                $module = '文章';
                break;
            case 'product':
                $module = '产品';
                break;
            case 'message':
                $module = '留言';
                break;
            case 'download':
                $module = '下载';
                break;
            case 'image':
                $module = '图片';
                break;
            case 'job':
                $module = '招聘';
                break;
            case 'link':
                $module = '链接';
                break;
        }
        return $module;
    }

    /**
     * 异步修改模块信息
     *
     *
    module_id:$(trs[i]).attr("id"),
    category:$(trs[i]).find("input[name=category]").val(),
    parent_id:$(trs[i]).attr("parentid"),
    seq:$(trs[i]).find("input[name=seq]").val(),
    ishid:$(trs[i]).find("select[name=ishid]").val(),
    module:$(trs[i]).find("select[name=module]").val(),
    url:$(trs[i]).find("input[name=url]").val()
     *
     *
     */
    public function actionAjax_ModuleEdit(){
        $modulestrs = $_POST['modulestrs'];
        $modulelist = json_decode($modulestrs);
        if(sizeof($modulelist)>0){
            foreach($modulelist as $module){
                if(empty($module->module_id)){
                    //添加模块
                    $command = $this->connection->createCommand("insert into xm_module (category,parentid,seq,lang,module,url,ishid) values (
                    :category,:parentid,:seq,:lang,:module,:url,:ishid)");
                    $command->bindParam(":category",$module->category,PDO::PARAM_STR);
                    $command->bindParam(":parentid",$module->parent_id,PDO::PARAM_INT);
                    $command->bindParam(":seq",$module->seq,PDO::PARAM_INT);
                    $command->bindParam(":lang",$this->mgrlang,PDO::PARAM_STR);
                    $command->bindParam(":module",$module->module,PDO::PARAM_STR);
                    $command->bindParam(":url",$module->url,PDO::PARAM_STR);
                    $command->bindParam(":ishid",$module->ishid,PDO::PARAM_INT);
                    $command->execute();
                    $insertid = Yii::app()->db->getLastInsertID();
                    if($module->parent_id == -1){
                        $this->connection->createCommand("update xm_module set iden = '{$insertid}::' where module_id = {$insertid}")->query();
                    }else{
                        $parentmodule = $this->connection->createCommand("select * from xm_module where module_id = {$module->parent_id}")->queryRow();
                        $this->connection->createCommand("update xm_module set iden = '{$parentmodule['iden']}{$insertid}::' where module_id = {$insertid}")->query();
                    }
                }else{
                    //修改模块
                    $command = $this->connection->createCommand("update xm_module set category =:category,seq =:seq,ishid=:ishid where module_id = :moduleid ");

                    $command->bindParam(":category",$module->category,PDO::PARAM_STR);
                    $command->bindParam(":seq",$module->seq,PDO::PARAM_INT);
                    $command->bindParam(":ishid",$module->ishid,PDO::PARAM_INT);
                    $command->bindParam(":moduleid",$module->module_id,PDO::PARAM_INT);
                    $command->execute();

                }
            }
        }
        $this->message(true,"编辑成功",null);
    }

    /*显示模块编辑页面*/
    public function actionShowedit(){

        $moduleid = $_GET['moduleid'];
        $module = $this->connection->createCommand("select * from xm_module where module_id = ".$moduleid)->queryRow();

        $parents = null;
        if($module['parentid']!=-1){
            //查看父类别的parentid是不是-1，是的话，就是二级菜单
            $parent = $this->connection->createCommand("SELECT * FROM xm_module where module_id = ".$module['parentid']." ")->queryRow();
            if($parent['parentid'] == -1){
                //是二级菜单
                $parents = $this->connection->createCommand("SELECT * FROM xm_module module where module.parentid = -1 and lang = '".$this->mgrlang."' ORDER BY iden,seq desc")->queryAll();
                $this->data['parents'] = $parents;
            }else{
                //三级菜单
                $parents = $this->connection->createCommand("SELECT * FROM xm_module module where (module.parentid = -1 or module.parentid in (SELECT m.module_id FROM xm_module m where m.parentid = -1)) and lang = '".$this->mgrlang."' ORDER BY iden,seq desc")->queryAll();
                $this->data['parents'] = $parents;
            }
        }
        /*需要获取父类菜单，父类菜单只需要两层*/
//        $parents = $this->connection->createCommand("SELECT * FROM xm_module module where (module.parentid = -1 or module.parentid in (SELECT m.module_id FROM xm_module m where m.parentid = -1)) and lang = '".$this->mgrlang."' ORDER BY iden,seq desc")->queryAll();
//        $this->data['parents'] = $parents;

        $this->data['module'] = $module;
        $this->render ('showedit',$this->data);
    }

    /*对模块进行编辑

    参数列表
    module_id:$("input[name=module_id]").val(),
    parentid:$("select[name=parentid]").val(),
    seq:$("input[name=seq]").val(),
    target:$("select[name=target]").val(),
    module:$("input[name=module]").val();
    category:$("input[name=category]").val();
    content:content,
        url:url
    */
    public function actionEdit(){
        $module_id = $_POST['module_id'];
        $module = $_POST['module'];
        $parentid = $_POST['parentid'];
        $target = $_POST['target'];
        $seq = $_POST['seq'];
        $category = $_POST['category'];
        $content = $_POST['content'];
        $url = $_POST['url'];

        $moduleobj = $this->connection->createCommand("select * from xm_module where module_id = ".$module_id)->queryRow();

        $transaction=$this->connection->beginTransaction();
        try
        {
            //判断父类栏目是否改变，更新iden
            if(!empty($parentid) && $moduleobj['parentid'] != $parentid){
                //父类栏目已经改变，修改iden
                $parentmodule = $this->connection->createCommand("select * from xm_module where module_id = {$parentid}")->queryRow();
                $this->connection->createCommand("update xm_module set iden = '{$parentmodule['iden']}{$module_id}::',parentid={$parentid} where module_id = {$module_id}")->query();
            }

            if($module=='link'){
                //链接
                $this->connection->createCommand("update xm_module set target = '{$target}',seq ={$seq},category='{$category}',url='{$url}' where module_id = {$module_id} ")->execute();
            }else if($module =='guide'){
                //内容
                $this->connection->createCommand("update xm_module set target = '{$target}',seq ={$seq},category='{$category}',content='{$content}' where module_id = {$module_id} ")->execute();
            }else{
                $this->connection->createCommand("update xm_module set target = '{$target}',seq ={$seq},category='{$category}' where module_id = {$module_id} ")->execute();
            }
        }
        catch(Exception $e){
            $transaction->rollBack();
        }
        $this->message(true,null,null);
    }

    public function actionDel(){
        $moduleid = $_GET['moduleid'];

        $moduleobj = $this->connection->createCommand("select *,(select count(1) from xm_module where parentid = m.module_id) c from xm_module m where module_id  = ".$moduleid)->queryRow();
        if($moduleobj['c']>0){
            $this->message(false,"该栏目下存在子栏目，请先删除子栏目");
            exit();
        }

        $transaction=$this->connection->beginTransaction();
        try
        {
            if($moduleobj['module']=='link'||$moduleobj['module']=='guide'){
                $this->connection->createCommand("delete from xm_module where module_id = ".$moduleid)->execute();
            }else if($moduleobj['module']=='article'){
                $this->connection->createCommand("delete from xm_module where module_id = ".$moduleid)->execute();
                $this->connection->createCommand("delete from xm_article where module_id = ".$moduleid)->execute();
            }else if($moduleobj['module']=='product'){
                $this->connection->createCommand("DELETE FROM xm_article_product  where article_id in (
                select article_id from xm_article where module_id = ".$moduleid."
                )")->execute();
                $this->connection->createCommand("delete from xm_article where module_id = ".$moduleid)->execute();
                $this->connection->createCommand("delete from xm_module where module_id = ".$moduleid)->execute();
            }else if($moduleobj['module']=='feedback'){
                $this->connection->createCommand("delete from xm_feedback where module_id = ".$moduleid)->execute();
                $this->connection->createCommand("delete from xm_module where module_id = ".$moduleid)->execute();
            }else if($moduleobj['module']=='message'){
                $this->connection->createCommand("delete from xm_message where module_id = ".$moduleid)->execute();
                $this->connection->createCommand("delete from xm_module where module_id = ".$moduleid)->execute();
            }else if($moduleobj['module']=='download'){
                $this->connection->createCommand("delete from xm_article where module_id = ".$moduleid)->execute();
                $this->connection->createCommand("delete from xm_module where module_id = ".$moduleid)->execute();
            }else if($moduleobj['module']=='image'){
                $this->connection->createCommand("DELETE FROM xm_article_images  where article_id in (
                select article_id from xm_article where module_id = ".$moduleid."
                )")->execute();
                $this->connection->createCommand("delete from xm_article where module_id = ".$moduleid)->execute();
                $this->connection->createCommand("delete from xm_module where module_id = ".$moduleid)->execute();
            }else if($moduleobj['module']=='job'){
                $this->connection->createCommand("DELETE FROM xm_article_job  where article_id in (
                select article_id from xm_article where module_id = ".$moduleid."
                )")->execute();
                $this->connection->createCommand("delete from xm_article where module_id = ".$moduleid)->execute();
                $this->connection->createCommand("delete from xm_module where module_id = ".$moduleid)->execute();
            }
        }
        catch(Exception $e){
            $transaction->rollBack();
        }

        $this->message(true,null,null);
    }

    /*public function actionAjaxEdit(){

        $module_id = $_POST['module_id'];
        $parentid = $_POST['parentid'];
        $category = $_POST['category'];
        $seq = $_POST['seq'];
        $target = $_POST['target'];
        $module = $_POST['module'];
        $url = $_POST['url'];
        $ishid = $_POST['ishid'];

        if($target==""){
            $target = "_self";
        }
        if($ishid==""){
            $ishid = 0;
        }

        if($module_id==""){
            //添加
            $this->connection->createCommand("insert into xm_module (category,parentid,seq,target,module,url,lang,ishid) values ('{$category}',{$parentid},{$seq},'{$target}','{$module}','{$url}','".$this->mgrlang."',{$ishid})")->query();
            $insertid = Yii::app()->db->getLastInsertID();
            if($parentid == -1){
                $this->connection->createCommand("update xm_module set name = '{$insertid}::' where module_id = {$insertid}")->query();
            }else{
                $parentmodule = $this->connection->createCommand("select * from xm_module where module_id = {$parentid}")->queryRow();
                $this->connection->createCommand("update xm_module set name = '{$parentmodule['name']}{$insertid}::' where module_id = {$insertid}")->query();
            }

            if($module == 'guide' ){
                $this->connection->createCommand("insert into xm_guide (module_id,description,lang) values ({$insertid},'','".$this->mgrlang."')")->query();
            }

        }else{
            //修改
            $this->connection->createCommand("update xm_module set category ='{$category}',parentid={$parentid},seq={$seq},target='{$target}',module='{$module}',url= '{$url}',ishid={$ishid}  where module_id = {$module_id} ")->query();
            if($parentid == -1){
                $this->connection->createCommand("update xm_module set name = '{$module_id}::' where module_id = {$module_id}")->query();
            }else{
                $parentmodule = $this->connection->createCommand("select * from xm_module where module_id = {$parentid}")->queryRow();
                $this->connection->createCommand("update xm_module set name = '{$parentmodule['name']}{$module_id}::',parentid={$parentid} where module_id = {$module_id}")->query();
            }
        }

//        $this->redirect("index");
        $this->message(true,"模块信息编辑成功");
    }

    public function actionJson($id){
        $module = $this->connection->createCommand("select m2.*,m1.category parentname from xm_module m2 left join xm_module m1 on m2.parentid = m1.module_id where m2.module_id = {$id} ")->queryRow();
        echo json_encode($module);
    }

    public function actionHavechild($id){
        $cldcunt = $this->connection->createCommand("select count(*) from xm_module where parentid = {$id}")->queryScalar();
        echo $cldcunt;
    }*/



    /*public function actionAjaxDel($id){
        $module = $this->connection->createCommand("select * from xm_module where module_id = {$id}")->queryRow();
        $mod = $module['module'];
        switch($mod){
            case 'guide':
                $this->connection->createCommand("delete from xm_guide where module_id = {$id}")->query();
                break;
            case 'article':
                $this->connection->createCommand("delete from xm_article where module_id = {$id}")->query();
                break;
            case 'product':
                $this->connection->createCommand("delete from xm_product where module_id = {$id}")->query();
                break;
            case 'message':
                $this->connection->createCommand("delete from xm_message where module_id = {$id}")->query();
                break;
            case 'download':
                $this->connection->createCommand("delete from xm_download where module_id = {$id}")->query();
                break;
            case 'image':
                $this->connection->createCommand("delete from xm_images where module_id = {$id}")->query();
                break;
            case 'employee':
                $this->connection->createCommand("delete from xm_employee where module_id = {$id}")->query();
                break;
            case 'feedback':
                $this->connection->createCommand("delete from xm_feedback where module_id = {$id}")->query();
                break;
        }

        $this->connection->createCommand("delete from xm_module where module_id = {$id}")->query();
        $this->message(true,"模块信息删除成功");
    }

    public function actionDel($id){
        $module = $this->connection->createCommand("select * from xm_module where module_id = {$id}")->queryRow();
        $mod = $module['module'];
        switch($mod){
            case 'guide':
                $this->connection->createCommand("delete from xm_guide where module_id = {$id}")->query();
                break;
            case 'article':
                $this->connection->createCommand("delete from xm_article where module_id = {$id}")->query();
                break;
            case 'product':
                $this->connection->createCommand("delete from xm_product where module_id = {$id}")->query();
                break;
            case 'message':
                $this->connection->createCommand("delete from xm_message where module_id = {$id}")->query();
                break;
            case 'download':
                $this->connection->createCommand("delete from xm_download where module_id = {$id}")->query();
                break;
            case 'image':
                $this->connection->createCommand("delete from xm_images where module_id = {$id}")->query();
                break;
            case 'employee':
                $this->connection->createCommand("delete from xm_employee where module_id = {$id}")->query();
                break;
            case 'feedback':
                $this->connection->createCommand("delete from xm_feedback where module_id = {$id}")->query();
                break;
        }

        $this->connection->createCommand("delete from xm_module where module_id = {$id}")->query();
        $this->redirect("index");
    }

    public function actionTree(){
        $modules = $this->connection->createCommand("select module_id as id,parentid pId,category as `name` from xm_module where lang = '".$this->mgrlang."' order by seq asc ")->queryAll();
        $modules[] = Array('id'=>-1,'name'=>'根目录','pid'=>0,'open'=>true);
        echo json_encode($modules);
    }
    public function actionTreeByType($type,$moduleid){
        $modules = $this->connection->createCommand("select module_id as id,parentid pId,category as `name`,module from xm_module where lang = '".$this->mgrlang."'  order by seq asc  ")->queryAll();
        $modules_array = Array();
        foreach($modules as $m){
            $m['open'] = true;
            if($m['module']!=$type){
                $m['nocheck'] = true;
            }
            if($moduleid == $m['id']){
                $m['checked'] = true;
            }
            $modules_array[] = $m;
        }
        echo json_encode($modules_array);
    }

    public function actionRoletree($lang){
        $modules = $this->connection->createCommand("select module_id as id,parentid pId,category as `name`,'true' as`open` from xm_module where lang = '".$lang."'")->queryAll();
        echo json_encode($modules);
    }*/


	
}