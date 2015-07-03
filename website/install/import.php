<?php
require 'db/DB.php';
$db = new DB();

$file_name = 'xmcms.sql';
$fp = @fopen($file_name, "r") or die("不能打开SQL文件 $file_name"); //打开文件
while ($SQL = GetNextSQL()) {
    if (!mysql_query($SQL)) {
        echo "执行出错：" . mysql_error() . "";
        echo "SQL语句为：" . $SQL . "";
    };
}
echo 1;

fclose($fp) or die("Can’t close file $file_name"); //关闭文件
mysql_close();

//从文件中逐条取SQL
function GetNextSQL()
{
    global $fp;
    $sql = "";
    while ($line = @fgets($fp, 40960)) {
        $line = trim($line);
        //以下三句在高版本php中不需要，在部分低版本中也许需要修改
        $line = str_replace("////", "//", $line);
        $line = str_replace("/’", "’", $line);
        $line = str_replace("//r//n", chr(13) . chr(10), $line);
//                        $line = stripcslashes($line);
        if (strlen($line) > 1) {
            if ($line[0] == "-" && $line[1] == "-") {
                continue;
            }
        }
        $sql .= $line . chr(13) . chr(10);
        if (strlen($line) > 0) {
            if ($line[strlen($line) - 1] == ";") {
                break;
            }
        }
    }
    return $sql;
}