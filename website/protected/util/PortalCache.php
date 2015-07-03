<?php
class PortalCache{

    private $yiiapp;
    private $conn;

    function __construct($yiiapp,$cthis){
        $this->yiiapp = $yiiapp;
        $this->cthis = $cthis;
    }

    function get($id,$time=null){
        $value = $this->yiiapp->cache->get($id);
        if($value == false){
            $value = $this->$id($id,$time);
        }
        $this->set($id,$value,$time);
        return $value;
    }

    function getL($id,$time=null){
        $lname = $id.$this->yiiapp->language;
        $value = $this->yiiapp->cache->get($lname);
//        if($value == false){
            eval('$value = $this->$id();');
//        }
        $this->set($lname,$value,$time);
        return $value;
    }

    function getLwithArgs($id,$args,$time=null){
        $lname = md5($id.$args).$this->yiiapp->language;
        $value = $this->yiiapp->cache->get($lname);

//        if($value == false){
            $value = $this->$id($args);
//        }
        $this->set($lname,$value,$time);
        return $value;
    }



    function set($id,$value,$time){
        if($time!=null){
            $this->yiiapp->cache->set($id,$value,$time);
        }else{
            $this->yiiapp->cache->set($id,$value);
        }
    }

    function modules(){
        $modules = $this->cthis->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where co.lang = '".$this->yiiapp->language."' and co.parentid =-1 and co.ishid = 0 order by co.seq asc")->queryAll();
        $i=0;
        foreach ($modules as $c){
            if($c['cldcount']>0){
                $modules[$i]['childs'] = $this->cthis->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where co.lang = '".$this->yiiapp->language."' and co.parentid ='".$c['module_id']."'  and co.ishid = 0  order by co.seq asc")->queryAll();
                $j=0;
                foreach($modules[$i]['childs'] as $cd){
                    if($cd['cldcount']>0){
                        $modules[$i]['childs'][$j]['childs'] = $this->cthis->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where co.lang = '".$this->yiiapp->language."' and co.parentid ='".$cd['module_id']."'  and co.ishid = 0  order by co.seq asc")->queryAll();
                    }
                    $j++;
                }
            }
            $i++;
        }
        return $modules;
    }

    function fragment(){
        $fragment_map =array();
        $fragment = $this->cthis->connection->createCommand("select * from xm_fragment where lang = '".$this->yiiapp->language."'")->queryAll();
        foreach($fragment as $f){
            $fragment_map[$f['key']] = $f;
        }
        return $fragment_map;
    }

    function config_basic(){
        $basicArray = array();
        $config_basic = $this->cthis->connection->createCommand("select * from xm_config where lang = '".$this->yiiapp->language."' and keytype= 'basic'")->queryAll();
        foreach($config_basic as $b){
            $basicArray[$b['syskey']] = $b;
        }
        return $basicArray;
    }

    //获取flash键值对
    function flashs(){
        $flashArray = Array();
        $flashs = $this->cthis->connection->createCommand("select * from xm_flash where lang = '".$this->yiiapp->language."'")->queryAll();
        foreach($flashs as $f){
            $flashArray[$f['name']] =  $this->cthis->connection->createCommand("select * from xm_flashimages where flash_id = {$f['flash_id']} order by seq asc")->queryAll();
        }
        return $flashArray;
    }



    function modulelist($moduleid){
        $modules = $this->cthis->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where co.lang = '".$this->yiiapp->language."' and module_id = {$moduleid}")->queryAll();
        $i=0;
        foreach ($modules as $c){
            if($c['cldcount']>0){
                $modules[$i]['childs'] = $this->cthis->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where co.lang = '".$this->yiiapp->language."' and co.parentid ='".$c['module_id']."'")->queryAll();
                $j=0;
                foreach($modules[$i]['childs'] as $cd){
                    if($cd['cldcount']>0){
                        $modules[$i]['childs'][$j]['childs'] = $this->cthis->connection->createCommand("select *,(select count(module_id) from xm_module where parentid = co.module_id) as cldcount from xm_module co where co.lang = '".$this->yiiapp->language."' and co.parentid ='".$cd['module_id']."'")->queryAll();
                    }
                    $j++;
                }
            }
            $i++;
        }
        return $modules;
    }

    /**获取导航的普通列表 START*/
    function menulist($id){
        $topid = $this->getTopModuleid($id);
        return $this->getMenuList2($topid);
    }

    function getTopModuleid($id){
        $module = $this->cthis->connection->createCommand("select * from xm_module where module_id = {$id}")->queryRow();
        if($module['parentid']==-1){
            return $module['module_id'];
        }else{
            return $this->getTopModuleid($module['parentid']);
        }
    }

    function getMenuList($topid){
        $module = $this->cthis->connection->createCommand("select m.*,(select count(*) from xm_module where parentid = m.module_id) childcount from xm_module m where m.module_id = {$topid} and m.ishid = 0 ")->queryRow();
        if($module['childcount']>0){
            $children = $this->cthis->connection->createCommand("select m.*,(select count(*) from xm_module where parentid = m.module_id) childcount from xm_module m where m.parentid = {$module['module_id']}  and m.ishid = 0 order by m.seq asc ")->queryAll();
            $children_array = Array();
            foreach($children as $c){
                $cld = $this->getMenuList($c['module_id']);
                $children_array[]=$cld;
            }
            $module['children'] = $children_array;
        }
        return $module;
    }

    /*树栏目展现*/
    function getMenuList2($topid){
        $module = $this->cthis->connection->createCommand("select m.*,(select count(*) from xm_module where parentid = m.module_id) childcount from xm_module m where m.module_id = {$topid}  ")->queryRow();
        if($module['childcount']>0){
            $children = $this->cthis->connection->createCommand("select m.*,(select count(*) from xm_module where parentid = m.module_id) childcount from xm_module m where m.parentid = {$module['module_id']}  order by m.seq asc ")->queryAll();
            $children_array = Array();
            foreach($children as $c){
                $cld = $this->getMenuList2($c['module_id']);
                $children_array[]=$cld;
            }
            $module['children'] = $children_array;
        }
        return $module;
    }

    /**获取导航的普通列表 END*/
    function guide($id){
        $guide = $this->cthis->connection->createCommand("select g.*,m.category from xm_guide g left join xm_module m on g.module_id = m.module_id where g.module_id =  {$id}")->queryRow();
        return $guide;
    }

    function getmodule($module){
        $module = $this->cthis->connection->createCommand(" select m.*,LENGTH(m.`name`) ml from xm_module m where m.module = '{$module}' and lang = '".$this->yiiapp->language."' ORDER BY ml asc,seq asc limit 0,1 ")->queryRow();
        return $module;
    }

    function getmodulebyid($id){
        $module = $this->cthis->connection->createCommand("select * from xm_module where module_id = {$id}  ")->queryRow();
        return $module;
    }

    function articleTop($data){
        $article =  $this->cthis->connection->createCommand("select a.*,u.username from xm_article a left join xm_user u on a.sender_id = u.user_id where a.module_id  ={$data['module']} and a.lang = '".$this->yiiapp->language."' limit 0,{$data['topnum']} ")->queryAll();
        return $article;
    }

    function getProducts($args){
        $start = ($args['page']-1)*$args['rows'];
        $products = $this->cthis->connection->createCommand("select p.*,u.username,m.category,m.module,m.module_id from xm_product p left join xm_module m on p.module_id = m.module_id left join xm_user u on p.sender_id = u.user_id where m.`name`  like '{$args['module']['name']}%' and p.lang ='".$this->yiiapp->language."'  order by orderby asc  limit {$start},".$args['rows'])->queryAll();
        $products_array = Array();
        foreach($products as $p){
            $p['tags'] = $this->cthis->connection->createCommand("select * from xm_tag where type = 'product' and relid = {$p['product_id']}")->queryAll();
            $products_array[] = $p;
        }
        return $products_array;
    }

    function getTagInfo($args){
        $start = ($args['page']-1)*$args['rows'];
        $taginfo = $this->cthis->connection->createCommand("
        select t.*,p.productname as title,p.productdesc as content,p.createtime,m.category,m.module_id,u.username from xm_tag t
        left JOIN xm_product p on t.relid = p.product_id
        right join xm_module m on p.module_id = m.module_id
        left join xm_user u on p.sender_id = u.user_id
        where t.type = 'product' and t.lang = '".$this->yiiapp->language."' and t.tag like '%".$args['search']."%'
        union
        select t.*,a.title,a.description as content,a.createtime,m.category,m.module_id,u.username  from xm_tag t
        left JOIN xm_article a on t.relid = a.article_id
        right join xm_module m on a.module_id = m.module_id
        left join xm_user u on a.sender_id = u.user_id
        where t.type = 'article' and t.lang = '".$this->yiiapp->language."' and t.tag like '%".$args['search']."%'
        union
        select t.*,d.title,d.description content,d.createtime,m.category,m.module_id,u.username  from xm_tag t
        left JOIN xm_download d on t.relid = d.download_id
        left join xm_module m on d.module_id = m.module_id
        left join xm_user u on d.sender_id = u.user_id
        where t.type = 'download' and t.lang = '".$this->yiiapp->language."' and t.tag like '%".$args['search']."%'
        union
        select t.*,i.title,i.description as content,i.createtime,m.category,m.module_id,u.username  from xm_tag t
        left JOIN xm_images i on t.relid = i.image_id
        left join xm_module m on i.module_id = m.module_id
        left join xm_user u on i.sender_id = u.user_id
        where t.type = 'image' and t.lang = '".$this->yiiapp->language."' and t.tag like '%".$args['search']."%'
        ORDER BY createtime desc
        limit {$start},".$args['rows'])->queryAll();
        return $taginfo;
    }

    function getTagInfoRowcounts($args){
        $records = $this->cthis->connection->createCommand("
        select count(1) as c from xm_tag t
        left JOIN xm_product p on t.relid = p.product_id
        where t.type = 'product' and t.lang = '".$this->yiiapp->language."' and t.tag like '%".$args['search']."%'
        union
        select count(1) as c from xm_tag t
        left JOIN xm_article a on t.relid = a.article_id
        where t.type = 'article' and t.lang = '".$this->yiiapp->language."'  and t.tag like '%".$args['search']."%'
        union
        select count(1) as c from xm_tag t
        left JOIN xm_download d on t.relid = d.download_id
        where t.type = 'download' and t.lang = '".$this->yiiapp->language."'  and t.tag like '%".$args['search']."%'
        union
        select count(1) as c from xm_tag t
        left JOIN xm_images i on t.relid = i.image_id
        where t.type = 'image' and t.lang = '".$this->yiiapp->language."'  and t.tag like '%".$args['search']."%'
        ")->queryAll();
        $c = 0;
        foreach($records as $r){
            $c+=$r['c'];
        }
        return $c;
    }

    function getArticles($args){
        $start = ($args['page']-1)*$args['rows'];
        $articles = $this->cthis->connection->createCommand("select a.*,u.username,m.category,m.module  from xm_article a left join xm_module m on a.module_id = m.module_id  left join xm_user u on a.sender_id = u.user_id where m.`name`  like '{$args['module']['name']}%' and a.lang ='".$this->yiiapp->language."'  order by orderby asc  limit {$start},".$args['rows'])->queryAll();
        $articles_array = Array();
        foreach($articles as $a){
            $a['tags'] = $this->cthis->connection->createCommand("select * from xm_tag where type = 'article' and relid = {$a['article_id']}")->queryAll();
            $articles_array[] = $a;
        }
        return $articles_array;
    }

    function getMessages($args){
        $start = ($args['page']-1)*$args['rows'];
        $messages = $this->cthis->connection->createCommand("select ms.*,u1.username replayer from xm_message ms left join xm_module m on ms.module_id = m.module_id left join xm_user u1 on ms.replyuser_id = u1.user_id where m.`name`  like '{$args['module']['name']}%' and ms.lang ='".$this->yiiapp->language."'  and ms.isAuth = 1   order by createtime desc  limit {$start},10")->queryAll();
        return $messages;
    }

    function getDownloads($args){
        $start = ($args['page']-1)*$args['rows'];
        $downloads = $this->cthis->connection->createCommand("select d.*,m.module_id,m.category,m.module from xm_download d left join xm_module m on d.module_id = m.module_id where m.`name`  like '{$args['module']['name']}%' and d.lang ='".$this->yiiapp->language."'  order by createtime desc  limit {$start},".$args['rows'])->queryAll();
        $downloads_array = Array();
        foreach($downloads as $d){
            $d['tags'] = $this->cthis->connection->createCommand("select * from xm_tag where type = 'download' and relid = {$d['download_id']}")->queryAll();
            $downloads_array[] = $d;
        }
        return $downloads_array;
    }

    function getImages($args){
        $start = ($args['page']-1)*$args['rows'];
        $images = $this->cthis->connection->createCommand("select i.*,u.username,m.category from xm_images i left join xm_module m  on i.module_id = m.module_id left join xm_user u on i.sender_id = u.user_id where m.`name`  like '{$args['module']['name']}%' and i.lang ='".$this->yiiapp->language."'  order by createtime desc  limit {$start},".$args['rows'])->queryAll();
        $images_array = Array();
        foreach($images as $i){
            $i['tags'] = $this->cthis->connection->createCommand("select * from xm_tag where type = 'image' and relid = {$i['image_id']}")->queryAll();
            $images_array[] = $i;
        }
        return $images_array;
    }

    function getEmployees($args){
        $start = ($args['page']-1)*$args['rows'];
        $employees = $this->cthis->connection->createCommand("select e.* from xm_employee e left join xm_module m on e.module_id = m.module_id where m.`name`  like '{$args['module']['name']}%' and e.lang ='".$this->yiiapp->language."'  order by createtime desc  limit {$start},".$args['rows'])->queryAll();
        $employees_array = Array();
        foreach($employees as $i){
            $i['tags'] = $this->cthis->connection->createCommand("select * from xm_tag where type = 'employee' and relid = {$i['employ_id']}")->queryAll();
            $employees_array[] = $i;
        }
        return $employees_array;
    }

    function getFeedbacks($args){
        $start = ($args['page']-1)*10;
        $feedbacks = $this->cthis->connection->createCommand("select f.* from xm_feedback f left join xm_module m on f.module_id = m.module_id where m.`name`  like '{$args['module']['name']}%' and f.lang ='".$this->yiiapp->language."'  order by createtime desc  limit {$start},10")->queryAll();
        return $feedbacks;
    }

    function getproductbyid($pid){
        $product =  $this->cthis->connection->createCommand("select * from xm_product where product_id = {$pid}")->queryRow();
        $product['tags'] = $this->cthis->connection->createCommand("select tag from xm_tag where type = 'product' and relid =  ".$pid)->queryAll();
        return $product;
    }

    function getimagebyid($id){
        $image =  $this->cthis->connection->createCommand("select * from xm_images where image_id = {$id}")->queryRow();
        $image['tags'] = $this->cthis->connection->createCommand("select tag from xm_tag where type = 'image' and relid =  ".$id)->queryAll();
        return $image;
    }

    function getdownloadbyid($id){
        $download = $this->cthis->connection->createCommand("select * from xm_download where download_id = {$id}")->queryRow();
        $download['tags'] = $this->cthis->connection->createCommand("select tag from xm_tag where type = 'download' and relid =  ".$id)->queryAll();
        return $download;
    }

    function getemployeebyid($id){
        return $this->cthis->connection->createCommand("select * from xm_employee where employ_id = {$id}")->queryRow();
    }

    function getProductsRowcounts($args){
        return $this->cthis->connection->createCommand("select count(*) from xm_product p left join xm_module m on p.module_id = m.module_id where m.name like '{$args['module']['name']}%'")->queryScalar();
    }

    function getArticlesRowcounts($args){
        return $this->cthis->connection->createCommand("select count(*) from xm_article a left join xm_module m on a.module_id = m.module_id where m.name like '{$args['module']['name']}%'")->queryScalar();
    }

    function getDownloadRowcounts($args){
        return $this->cthis->connection->createCommand("select count(*) from xm_download d left join xm_module m on d.module_id = m.module_id where m.name like '{$args['module']['name']}%'")->queryScalar();
    }

    function getImageRowcounts($args){
        return $this->cthis->connection->createCommand("select count(*) from xm_images i left join xm_module m on i.module_id = m.module_id where m.name like '{$args['module']['name']}%'")->queryScalar();
    }

    function getEmployeeRowcounts($args){
        return $this->cthis->connection->createCommand("select count(*) from xm_employee e left join xm_module m on e.module_id = m.module_id where m.name like '{$args['module']['name']}%'")->queryScalar();
    }

    function getMessageRowcounts($args){
        return $this->cthis->connection->createCommand("select count(*) from xm_message me left join xm_module m on me.module_id = m.module_id where m.name like '{$args['module']['name']}%' and me.isAuth = 1 ")->queryScalar();
    }

    function getArticlesById($id){
        $article =  $this->cthis->connection->createCommand("select * from xm_article a  LEFT JOIN xm_user u ON a.sender_id = u.user_id where a.article_id = {$id} ")->queryRow();
        $article['tags'] = $this->cthis->connection->createCommand("select tag from xm_tag where type = 'article' and relid =  ".$id)->queryAll();
        return $article;
    }

    function getFeedbacktype(){
        return $this->cthis->connection->createCommand("select * from xm_feedbacktype")->queryAll();
    }

    //得到最新的文章
    function getArticleTop($args){
        return $this->cthis->connection->createCommand("SELECT a.*, u.username,m.module, m.category FROM xm_article a LEFT JOIN xm_user u ON a.sender_id = u.user_id left join xm_module m  on a.module_id = m.module_id where a.lang ='".$this->yiiapp->language."'  order by createtime desc limit 0,".$args)->queryAll();
    }

    /**
     * @param $args 返回记录数
     * @return mixed
     *
     * 查询产品
     */
    function getProductTop($args){
        return $this->cthis->connection->createCommand("SELECT a.*, u.username,m.module, m.category FROM xm_product a LEFT JOIN xm_user u ON a.sender_id = u.user_id left join xm_module m  on a.module_id = m.module_id where a.lang ='".$this->yiiapp->language."'  order by orderby desc,product_id desc limit 0,".$args)->queryAll();
    }

    function getTags($args){
        $count = $this->cthis->connection->createCommand("select count(1) from xm_tag where lang ='".$this->yiiapp->language."' ")->queryScalar();
        if($count!=""){
            $start = 0;
            if($count>$args){
                $start = rand(0,$count-$args);
            }
            return $this->cthis->connection->createCommand("select * from xm_tag where lang ='".$this->yiiapp->language."' limit {$start},{$args} ")->queryAll();
        }
        return null;
    }

    function getFragment(){
        $fragments = $this->cthis->connection->createCommand("select * from xm_fragment where lang ='".$this->yiiapp->language."'")->queryAll();
        $fragments_array = Array();
        foreach($fragments as $f){
            $fragments_array[$f['key']]=$f['content'];
        }
        return $fragments_array;
    }

}