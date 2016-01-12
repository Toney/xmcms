<?php
$ip = $_REQUEST['ip'];
$port = $_REQUEST['port'];
$dbname = $_REQUEST['dbname'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

//生成文件。config.db.php
/*
 * $db_config["hostname"] = "localhost"; //服务器地址
$db_config["username"] = "root"; //数据库用户名
$db_config["password"] = "123"; //数据库密码
$db_config["database"] = "test"; //数据库名称
$db_config["charset"] = "utf8";//数据库编码
$db_config["pconnect"] = 1;//开启持久连接
$db_config["log"] = 0;//开启日志
$db_config["logfilepath"] = './';//开启日志
 */
$db_config["hostname"] = $ip;
$db_config['port']=$port;
$db_config["username"] = $username;
$db_config["password"] = $password;
$db_config["database"] = $dbname;
$db_config["charset"] = "utf8";//数据库编码
$db_config["pconnect"] = 1;//开启持久连接
$db_config["log"] = 0;//开启日志
$db_config["logfilepath"] = './';//开启日志

/*序列化数据库连接结构，然后进行存储！！*/
file_put_contents("db/config.db.php",serialize($db_config));

require 'db/DB.php';

$db = new DB();

echo $db->isconnect;
?>
