<?php
require Yii::app()->basePath.'/util/CrmFun.php';
class AppController extends CController
{

    public $layout = '//layouts/app';
    public $menu = array();
    public $breadcrumbs = array();
    public $connection;
    public $data = array();
    public $portalCache;
    public $isrewrite = 0;
    public $lang = "";
    public $topid = 0;
    public $home = 0;

    public function init()
    {
        //根据模块
        if($this->module->id == 'wap'){
            $this->layout = "wap";
        }else{

            if (isset($_GET['lang']) && $_GET['lang'] != "") {
                // 通过传递参数更改语言
                Yii::app()->language = $_GET['lang'];
                // 设置COOKIE，
                Yii::app()->request->cookies['lang'] = new CHttpCookie('lang', $_GET['lang']);
            } else if (isset(Yii::app()->request->cookies['lang']) && Yii::app()->request->cookies['lang']->value != "") {
                // 根据COOKIE中语言类型来设置语言
                Yii::app()->language = Yii::app()->request->cookies['lang']->value;
            }
            /*
            else
            {
                // 根据浏览器语言来设置语言
                $lang = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
                Yii::app()->language = strtolower(str_replace('-', '_', $lang[0]));
            }*/
        }

        if (Yii::app()->language != 'zh_cn') {
            Yii::app()->sourceLanguage = 'zh_cn';
        }

        $this->lang = Yii::app()->language;

        $this->connection = Yii::app()->db;
        $this->initAppCache();


    }

    public function cacheKey($key)
    {
        return $key . "_" . Yii::app()->language;
    }

    public function getCache($key)
    {
        return Yii::app()->cache->get($this->cacheKey($key));
    }

    /*初始化系统缓存*/
    public function initAppCache()
    {
        $LANGALL = Yii::app()->cache->get('LANGALL');
        if ($LANGALL == false) {
            $LANGALL = $this->connection->createCommand("select * from xm_lang where mark !='xmcms'")->queryAll();
            Yii::app()->cache->set('LANGALL', $LANGALL);
        }
        Yii::app()->params['LANGALL'] = $LANGALL;

        $APPCONFIG = Yii::app()->cache->get($this->cacheKey("APPCONFIG"));
        if ($APPCONFIG == false) {
            //全局配置
            $APPCONFIG = $this->connection->createCommand("select * from xm_config where lang = '" . Yii::app()->language . "' or lang = 'system'")->queryAll();
            $APPCONFIGLIST = Array();
            foreach ($APPCONFIG as $a) {
                $APPCONFIGLIST[$a['syskey']] =$a['content'];
            }
            Yii::app()->cache->set($this->cacheKey("APPCONFIG"), $APPCONFIGLIST);
        }
        Yii::app()->params['APPCONFIG'] = Yii::app()->cache->get($this->cacheKey("APPCONFIG"));
        $this->isrewrite = $APPCONFIG['isrewrite'];
        $this->data['APPCONFIG'] = Yii::app()->cache->get($this->cacheKey("APPCONFIG"));

        $MODULES = Yii::app()->cache->get($this->cacheKey("MODULES"));
        if ($MODULES == false) {
            //全局模块
            $MODULES = $this->getModules();
            Yii::app()->cache->set($this->cacheKey("MODULES"), $MODULES);
        }
        $this->data['MODULES'] = Yii::app()->cache->get($this->cacheKey("MODULES"));
        Yii::app()->params['MODULES'] =Yii::app()->cache->get($this->cacheKey("MODULES"));

        //最新公告
        $LASTNOTICE = Yii::app()->cache->get($this->cacheKey("LASTNOTICE"));
        if ($LASTNOTICE == false) {
            //全局模块
            $LASTNOTICE =$this->getTopArticleByModule(102,1);;
            Yii::app()->cache->set($this->cacheKey("LASTNOTICE"), $LASTNOTICE,60*60);
        }
        $this->data['LASTNOTICE'] = Yii::app()->cache->get($this->cacheKey("LASTNOTICE"));
        Yii::app()->params['LASTNOTICE'] =Yii::app()->cache->get($this->cacheKey("LASTNOTICE"));

        //片段数据 fragment
        $FRAGMENT = Yii::app()->cache->get($this->cacheKey("FRAGMENT"));
        if ($FRAGMENT == false) {
            //获取片段数据
            $FRAGMENT = $this->getFragment();;
            Yii::app()->cache->set($this->cacheKey("FRAGMENT"), $FRAGMENT);
        }
        $this->data['FRAGMENT'] = Yii::app()->cache->get($this->cacheKey("FRAGMENT"));
        Yii::app()->params['FRAGMENT'] =Yii::app()->cache->get($this->cacheKey("FRAGMENT"));


        /*最新公告*/
        $notice_id = 102;
        $lastnotice = Yii::app()->cache->get("lastnotice_".$notice_id);
        if($lastnotice==false){
            $lastnotice = $this->getTopArticleByModule($notice_id,5);
            Yii::app()->cache->set("lastnotice__".$notice_id, $lastnotice);
        }
        $this->data['lastnotice'] = $lastnotice;

//		$portalcache = new PortalCache(Yii::app(),$this);
//		$this->data['portalcache'] = $portalcache;
//		$this->data['modules'] = $portalcache->getL('modules');
//		$this->data['config_basic'] =$portalcache->getL('config_basic');
//		$this->data['flashs'] =$portalcache->getL('flashs');
//
//		$this->data['fragment'] =$portalcache->getL('fragment');

        $NOTICE = Yii::app()->cache->get($this->cacheKey("NOTICE"));
        if ($NOTICE == false) {
            if($this->lang=='zh_cn'){
                $NOTICE = $this->connection->createCommand("SELECT * FROM xm_article WHERE MODULE_ID = '26' LIMIT 0,1")->queryRow();
            }
            Yii::app()->cache->set($this->cacheKey("NOTICE"), $NOTICE);
        }
        Yii::app()->params['NOTICE'] = $NOTICE;
    }



    /*URL地址伪静态切换*/
    public function getUrl($controller, $action, $params = null)
    {
        if($this->isrewrite == 1){
            //urlwrite
            $url = $controller.'-'.$action;
            $i = 0;
            if(sizeof($params)>0){
                foreach($params as $k=>$v){
                    $url.="-".$k."-".$v;
                }
            }
            $url .=".html";
        }else{
            $url = "index.php?r=".$controller."/".$action;
            if(sizeof($params)>0){
                foreach($params as $k=>$v){
                    $url.="&".$k."=".$v;
                }
            }
        }
        return $url;
    }

    public function createUrl($rules, $params = Array(),$ampersand = '&'){
        $r = "";
        $url = Yii::app()->baseurl;
        if($rules == 'captcha'){
            if($this->isrewrite == 1){
                $r = "site-captcha";
            }else{
                $r = "site/captcha";
            }
        }else if($rules=='captcha_memberlogin'||$rules=='captcha_memberregister'||$rules=='captcha_forgetpassword'||$rules=='captcha_resetpassword'){
            if($this->isrewrite == 1){
                $r = "site-".$rules;
            }else{
                $r = "site/".$rules;
            }
        }else if($rules=='captcha_feedback'){
            if($this->isrewrite == 1){
                $r = "feedback-".$rules;
            }else{
                $r = "feedback/".$rules;
            }
        }else if($rules=='captcha_message'){
            if($this->isrewrite == 1){
                $r = "message-".$rules;
            }else{
                $r = "message/".$rules;
            }
        }else{
            $r = $rules!=null?$rules:$params['r'];
        }


        //修改对于分页URL地址的操作
        if($this->isrewrite == 1 && $this->module->id != 'wap'){
            //urlwrite
            $url = str_replace("/","-",$r);
            if(sizeof($params)>0){
                foreach($params as $k=>$v){
                    if($k!='r'){
                        $url.="-".$k."-".$v;
                    }
                }
            }
            $url .=".html";

        }else{
            $url .= "index.php?r=".$r;
            if(sizeof($params)>0){
                foreach($params as $k=>$v){
                    if($k!='r'){
                        $url.="&".$k."=".$v;
                    }
                }
            }
        }
        return $url;
    }

    public function langurl($lang = 'en_us')
    {
        if ($lang == Yii::app()->language) {
            return null;
        }

        $current_uri = Yii::app()->request->requestUri;
        if ($current_uri == '/index.php') {
            return $current_uri . '/site/index/lang/' . $lang;
        } else if ($current_uri == '/') {
            return 'index.php/site/index/lang/' . $lang;
        }

        if (strrpos($current_uri, 'lang/')) {
            //防止生成的 url 传值出现重复 lang/zh_cn
            $langstr = 'lang/' . Yii::app()->language;
            // /lang/zh_cn/
            $current_uri = str_replace('/' . $langstr . '/', '/', $current_uri);
            // /lang/zh_cn
            $current_uri = str_replace('/' . $langstr, '', $current_uri);
        }
        return $current_uri . '/lang/' . $lang;
    }

    function message($type,$message,$data=null){
        echo json_encode(Array('type'=>$type,'message'=>$message,'data'=>$data));
    }


    /***********************************************start 下面封装获取对应数据的方法类***************************************************/
    /*获取片段数据*/
    public function getFragment(){
        $FRAGMENT = Yii::app()->cache->get($this->cacheKey("FRAGMENT"));
        if($FRAGMENT==false){
            $FRAGMENTLIST = $this->connection->createCommand("select * from xm_fragment where lang = '".Yii::app()->language."' ")->queryAll();
            $FRAGMENT_NEW = Array();
            foreach($FRAGMENTLIST as $f){
                $FRAGMENT_NEW[$f['key']] = $f['content'];
            }
            $FRAGMENT = $FRAGMENT_NEW;
            Yii::app()->cache->set($this->cacheKey("FRAGMENT"), $FRAGMENT_NEW);
        }
        return $FRAGMENT;
    }

    /*获取产品数据*/
    public function getTopProductByModule($moduleid,$top){
        $products =  Yii::app()->cache->get($this->cacheKey("product_".$moduleid."_".$top));
        if($products==false){
            $products = $this->connection->createCommand("select * from xm_article a left join xm_module m on a.module_id = m.module_id left join xm_article_product p on a.article_id = p.article_id  where m.iden REGEXP '^{$moduleid}::.*$' or m.iden REGEXP '.*::{$moduleid}::.*$' order by  a.article_id desc ,a.seq desc,a.top desc,a.recommend desc,a.createtime desc limit 0,{$top}")->queryAll();
            Yii::app()->cache->set($this->cacheKey("product_".$moduleid."_".$top), $products,60*60);
        }
        return $products;
    }

    /*获取图片展示数据*/
    public function getTopImageByModule($moduleid,$top){
        $images =  Yii::app()->cache->get($this->cacheKey("images_".$moduleid."_".$top));
        if($images==false){
            $images = $this->connection->createCommand("select * from xm_article a left join xm_module m on a.module_id = m.module_id left join xm_article_image i on a.article_id = i.article_id  where m.iden REGEXP '^{$moduleid}::.*$' or m.iden REGEXP '.*::{$moduleid}::.*$' order by  a.article_id desc ,a.seq desc,a.top desc,a.recommend desc,a.createtime desc limit 0,{$top}")->queryAll();
            Yii::app()->cache->set($this->cacheKey("images_".$moduleid."_".$top), $images,60*60);
        }
        return $images;
    }

    /*获取所有的产品信息，在产品量比较少的情况下使用，用于页面的大块展示的时候使用*/
    public function getProductAll(){
        $PRODUCTSALL = Yii::app()->cache->get($this->cacheKey("PRODUCTSALL"));
        if($PRODUCTSALL==false){
            $PRODUCTSALL = $this->connection->createCommand("SELECT article.*,product.image FROM xm_article article
            left JOIN xm_article_product product on article.article_id = product.article_id
            WHERE infotype = 'product' ORDER BY seq desc,top desc,recommend desc,createtime desc,article_id desc  ")->queryAll();
            Yii::app()->cache->set($this->cacheKey("PRODUCTSALL"), $PRODUCTSALL);
        }
        return $PRODUCTSALL;
    }

    /*获取对应模块的文章，前多少个，并且按指定方法排序*/
    public function getTopArticleByModule($moduleid,$top){

        /*SELECT
                *
                FROM
            xm_article a
        LEFT JOIN xm_module m ON a.module_id = m.module_id
        WHERE
            m.iden REGEXP '^15::.*$' or m.iden REGEXP '.*::15::.*$'
        ORDER BY
            article_id DESC,
            a.seq DESC,
            a.top DESC,
            a.recommend DESC,
            a.createtime DESC*/

        $articles =  Yii::app()->cache->get($this->cacheKey("article_".$moduleid."_".$top));
        if($articles==false){
            $articles = $this->connection->createCommand("select * from xm_article a left join xm_module m on a.module_id = m.module_id  where m.iden REGEXP '^{$moduleid}::.*$' or m.iden REGEXP '.*::{$moduleid}::.*$' order by  article_id desc ,a.seq desc,a.top desc,a.recommend desc,a.createtime desc limit 0,{$top}")->queryAll();
            Yii::app()->cache->set($this->cacheKey("article_".$moduleid."_".$top), $articles,60*60);
        }
        return $articles;
    }

    /*根据模块ID，获取上下所有对应的模块信息，用于在详情页面进行导航栏的展现*/
    public function getQueueModulesById($topModuleid){
        $modules = $this->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where module_id = {$topModuleid} and co.parentid =-1  order by co.seq desc")->queryAll();
        $i = 0;
        foreach ($modules as $c) {
            if ($c['cldcount'] > 0) {
                $modules[$i]['childs'] = $this->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where  co.parentid ='" . $c['module_id'] . "'   order by co.seq desc")->queryAll();
                $j = 0;
                foreach ($modules[$i]['childs'] as $cd) {
                    if ($cd['cldcount'] > 0) {
                        $modules[$i]['childs'][$j]['childs'] = $this->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where co.parentid ='" . $cd['module_id'] . "'  order by co.seq desc")->queryAll();
                    }
                    $j++;
                }
            }
            $i++;
        }
        return $modules;
    }

    public function getModulesByParentId($parentid){
        $modules =  Yii::app()->cache->get($this->cacheKey("getModulesByParentId_".$parentid));
        if($modules==false){
            $modules = $this->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where  co.parentid ={$parentid} and  lang = '".Yii::app()->language."' order by co.seq desc")->queryAll();
            Yii::app()->cache->set($this->cacheKey("getModulesByParentId_".$parentid), $modules,60*60);
        }
        return $modules;
    }

    /**
     *
     * wap上面显示，只需要显示产品，图片，文章……
     *
     * @param $parentid
     * @return mixed
     */
    public function getModulesByParentIdForWap($parentid){
        $modules =  Yii::app()->cache->get($this->cacheKey("getModulesByParentId_".$parentid));
        if($modules==false){
            $modules = $this->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where  co.parentid ={$parentid} and module != 'link' and module !='feedback' and module !='message' and  lang = '".Yii::app()->language."' order by co.seq desc")->queryAll();
            Yii::app()->cache->set($this->cacheKey("getModulesByParentId_".$parentid), $modules,60*60);
        }
        return $modules;
    }

    /*根据模块ID获取所需要的*/
    public function getArticlesByModuleId($module_id){
        $articles = Yii::app()->cache->get($this->cacheKey("getArticlesByModuleId_".$module_id));
        if($articles == false){
            $articles = $this->connection->createCommand("select * from xm_article where module_id = {$module_id}")->queryAll();
            Yii::app()->cache->set($this->cacheKey("getArticlesByModuleId_".$module_id), $articles,60*60);
        }
        return $articles;
    }

    /*根据module_id获取module信息*/
    public function getModuleById($module_id){
        $module = Yii::app()->cache->get($this->cacheKey("getModuleById_".$module_id));
        if($module == false){
            $module = $this->connection->createCommand("select * from xm_module where module_id = {$module_id}")->queryRow();
            Yii::app()->cache->set($this->cacheKey("getModuleById_".$module_id), $module,60*60);
        }
        return $module;
    }

    /*获取到所有的模块，除了隐藏的*/
    function getModules()
    {
        $modules = $this->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id and ishid = 0) as cldcount from xm_module co where co.lang = '" . Yii::app()->language . "' and co.parentid =-1 and co.ishid = 0 order by co.seq desc")->queryAll();
        $i = 0;
        foreach ($modules as $c) {
            if ($c['cldcount'] > 0) {
                $modules[$i]['childs'] = $this->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id  and ishid = 0) as cldcount from xm_module co where co.lang = '" . Yii::app()->language . "' and co.parentid ='" . $c['module_id'] . "'  and co.ishid = 0  order by co.seq desc")->queryAll();
                $j = 0;
                foreach ($modules[$i]['childs'] as $cd) {
                    if ($cd['cldcount'] > 0) {
                        $modules[$i]['childs'][$j]['childs'] = $this->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id  and ishid = 0) as cldcount from xm_module co where co.lang = '" . Yii::app()->language . "' and co.parentid ='" . $cd['module_id'] . "'  and co.ishid = 0  order by co.seq desc")->queryAll();
                    }
                    $j++;
                }
            }
            $i++;
        }
        return $modules;
    }



    /*获取群组*/
    function getGroup(){
        $GROUPS = Yii::app()->cache->get($this->cacheKey("GROUPS"));
        if($GROUPS==false){
            $GROUPS = $this->connection->createCommand("SELECT * FROM xm_group WHERE LANG = '".Yii::app()->language."'")->queryAll();
            Yii::app()->cache->set($this->cacheKey("GROUPS"), $GROUPS);
        }
        return $GROUPS;
    }

    /**通过IDEN的格式获取模块最顶部的模块ID
     例如：66::68::
     */
    public function getTopIdFromIDEN($iden){
        return substr($iden,0,stripos($iden, '::'));
    }

    /**
     * 获取上一篇文章
     */
    public function getPrevArticle($articleid,$moduleid){
        return $this->connection->createCommand("select * from xm_article where article_id > {$articleid} and module_id = {$moduleid} order by article_id asc , seq desc,top desc,recommend desc,createtime desc limit 1")->queryRow();
    }

    /**
     * 获取下一篇文章
     */
    public function getNextArticle($articleid,$moduleid){
        return $this->connection->createCommand("select * from xm_article where article_id < {$articleid}  and module_id = {$moduleid}  order by  article_id desc ,seq desc,top desc,recommend desc,createtime desc limit 1")->queryRow();
    }


    /***********************************************end 下面封装获取对应数据的方法类***************************************************/


}

?>
<?php
//echo CHtml::link ( ' 中文简体 ' , $this->langurl('zh_cn')) . '| ' .
//    CHtml::link ( ' English ' ,$this->langurl('en_us')) ;
?>
<?php
//echo Yii::t('index','username');
//echo Yii::t('index','username','zh_cn');
//echo Yii::t('index','username','en_us');
?>
