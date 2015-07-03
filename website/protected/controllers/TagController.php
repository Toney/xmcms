<?php
Yii::import("application.util.PortalCache");
Yii::import("application.util.PageBar");
class TagController extends PortalController
{

    public function actionSearch(){
        $tag = $_REQUEST['tag'];
        $this->data['tag'] = $tag;

        $portalcache = $this->data['portalcache'];
        $pb = new PageBar();


        $page = $_REQUEST['page']==null?1:$_REQUEST['page'];

        $args['page'] = $page;
        $args['rows'] = $pb->rows;
        $args['search']=$tag;
        $this->data['taginfos'] = $portalcache->getLwithArgs('getTagInfo',$args,'getTagInfo_'.$tag.'_'.$page);

        $pb->page = $page;
        $pb->rowcounts = $portalcache->getLwithArgs('getTagInfoRowcounts',$args,'getTagInfoRowcounts_'.$tag);
        $pb->url = "/index.php/article/index/id/{$tag}";
        $this->data['pb'] = $pb;

        $this->render('search',$this->data);

    }

}