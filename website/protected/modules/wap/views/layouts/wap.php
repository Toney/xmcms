<?php
$APPCONFIG = Yii::app()->getParams()['APPCONFIG'];
$TITLE =  Yii::app()->getParams()['TITLE'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $TITLE==$APPCONFIG['webname']?"":$TITLE; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="css/wap/jquery.mobile-1.4.5.min.css" />-->
    <link rel="stylesheet" href="css/wap/themes/wap/wap.min.css" />
    <link rel="stylesheet" href="css/wap/themes/wap/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="css/wap/jquery.mobile.structure-1.4.5.min.css" />
    <script src="css/wap/jquery.min.js"></script>
    <script src="css/wap/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<?php echo $content; ?>
</body>
</html>
