<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>系统设置</span><span><i class="icon-angle-double-right"></i>上传文件管理</span>
</div>
<div class="grid_12 container">
    <div class="container_in">
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/css/admin/ckfinder/ckfinder.js "></script>
        <!--<script type="text/javascript" src="<?php /*echo Yii::app()->request->baseUrl*/?>/css/manage/plugins/ckfinder/lang/zh-cn.js"></script>-->
        <script type="text/javascript" charset="utf-8">
            $(function(){
                var ckfinder = new CKFinder();
                ckfinder.replace( 'ckfinder');
            });
        </script>
        <div class="form">
            <div id="ckfinder"></div>
        </div>
    </div>
</div>