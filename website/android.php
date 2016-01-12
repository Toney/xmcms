<?php
date_default_timezone_set('prc');
error_reporting(E_ALL ^ E_NOTICE);

if(file_exists("config/install.lock"))
{
    // change the following paths if necessary
    $yii=dirname(__FILE__).'/framework/yii.php';
    $config=dirname(__FILE__).'/protected/config/main.php';

    // remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG',true);
    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

    require_once($yii);
    Yii::createWebApplication($config)->run();
}
else
{
    header('Location:install/index.php');
}

