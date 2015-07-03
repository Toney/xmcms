<?php
Yii::import("application.modules.admin.util.FileUtil");
class TemplateController extends AppAdminController {

    public function actionIndex() {

        $fileutil = new FileUtil();
        $templates = $fileutil->getFileList('themes');
        $this->data['templates'] = $templates;

        $defTheme = $this->connection->createCommand("select content from xm_config where syskey = 'theme'")->queryScalar();
        $this->data['defTheme'] = $defTheme;

        $this->render ('index',$this->data);
    }

    public function actionSetDefault($template){
        $this->connection->createCommand("update xm_config set content = '".$template."' where syskey = 'theme'")->query();
        echo 1;
    }

    public function actionShowEdit($template){
        $this->data['template'] = $template;
        $this->render ('showedit',$this->data);
    }

    public function actionDelTemplate($template){

        $fileutil = new FileUtil();
        $fileutil ->deldir("themes/".$template);

        $defTheme = $this->connection->createCommand("select content from xm_config where syskey = 'theme'")->queryScalar();
        if($defTheme==$template){
            $templates = $fileutil->getFileList('themes');
            $this->actionSetDefault($templates[0]);
        }
        echo 1;
    }

    public function actionGetfilelist($template){
        $fileutil = new FileUtil();
        $dir = null;
        $loc = $_REQUEST['loc'];
        if($loc==null){
            $dir = 'themes/'.$template.'/views';
        }else{
            $dir = $loc;
        }
        $handler = opendir($dir);
        $files = Array();
        while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
            $extend = pathinfo($filename);
            $extend = strtolower($extend["extension"]);
            if ($filename != "." && $filename != ".."&&$extend!=="db") {
                if(is_dir($dir.'/'.$filename)){
                    $files[] = Array(name=>$filename,loc=>$dir.'/'.$filename,isParent=>true) ;
                }else{
                    $files[] = Array(name=>$filename,loc=>$dir.'/'.$filename,isParent=>false) ;
                }
            }
        }
        closedir($handler);
        echo json_encode($files);
    }

    public function actionGetcode($loc){
        echo file_get_contents($loc);
    }

    public function actionSettemplate(){
        file_put_contents($_REQUEST['loc'],$_REQUEST['htmlstr']);
        echo 1;
    }

}