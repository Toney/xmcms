<?php
require 'db/DB.php';
$db = new DB();
$password = $_REQUEST['password'];
$db->query("update xm_user set loginpass = '".md5($password)."' where loginname = 'administrator'");

//设置数据库文件
$db_config = unserialize(file_get_contents('db/config.db.php'));
$dbstr = "<?php
\$APP_DBSTR='mysql:host=".$db_config["hostname"].";port=".$db_config["port"].";dbname=".$db_config["database"]."';
\$APP_USERNAME='".$db_config["username"]."';
\$APP_PASSWORD='".$db_config["password"]."';";
file_put_contents("../config/db.php",$dbstr);


$filename="../config/install.lock";
$fp=fopen("$filename", "w+"); //打开文件指针，创建文件
fclose($fp);
echo 1;