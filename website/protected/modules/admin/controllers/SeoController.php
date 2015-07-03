<?php
class SeoController extends AppAdminController {

    public function actionClearcache() {
        Yii::app()->cache->flush();
        $this->resetCacheData();
        echo true;
    }

    function resetCacheData(){
        $configs = $this->connection->createCommand(" select * from xm_config where lang = 'system'")->queryAll();
        $configstr = "<?php ";
        foreach($configs as $c){
            $configstr .="\$APPCFG['".$c['syskey']."'] = '".$c['content']."';\n";
        }
        file_put_contents(Yii::app()->basePath."/../config/config.php",$configstr);
    }
}