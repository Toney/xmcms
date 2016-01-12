<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>小麦CMS信息提示页面&nbsp;-&nbsp;Power by XMCMS</title>

    <style type="text/css">

        ::selection{ background-color: #E13300; color: white; }
        ::moz-selection{ background-color: #E13300; color: white; }
        ::webkit-selection{ background-color: #E13300; color: white; }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body{
            margin: 0 15px 0 15px;
        }

        #container{
            margin: 10px;
            border: 1px solid #D0D0D0;
            -webkit-box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>

<div id="container">
    <h1>小麦CMS信息提示页面</h1>

    <div id="body">
        <p>请求地址：<?php echo Yii::app()->request->url; ?></p>
        <p>错误号：<?php echo $error['code']; ?></p>
        <p>错误类型：<?php echo $error['type']; ?></p>
        <p>错误信息：<?php echo $error['message']; ?></p>
        <p><a href="<?php echo Yii::app()->request->baseUrl ?>/">返回首页</a></p>
    </div>

</div>

</body>
</html>