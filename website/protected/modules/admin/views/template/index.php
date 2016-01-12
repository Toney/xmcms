<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>界面设置</span><span><i class="icon-angle-double-right"></i>模板设置</span>
</div>
<div class="grid_12 container">
    <div class="container_in">
        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th  class="tal">模板目录</th>
                <th>缩略图</th>
                <th>默认</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof ( $templates ) > 0) {
                foreach($templates as $t){
                    ?>
                    <tr>
                        <td class="tal"><?php echo $t;?></td>
                        <td class="tac"><a class="prviewimg" href="<?php echo Yii::app()->theme->baseUrl ?>/themes/<?php echo $t;?>/view.jpg" ><img src="/themes/<?php echo $t;?>/view.jpg" width="80px" height="80px" /></a></td>
                        <td>
                            <?php
                            if($defTheme == $t){
                                ?>
                                <i class="icon-ok green" ></i>
                                <?php
                            }else{
                                ?>
                                <i class="icon-cancel red" ></i>
                                <?php
                            }
                            ?>
                        </td>
                        <td class="last tac">
                            <a><i class="icon-ok" title="设为默认"  onclick="setDefault('<?php echo $t; ?>')" ></i></a>
                            <a><i class="icon-edit"  onclick="showedit('<?php echo $t; ?>')" ></i></a>
                            <a><i class="icon-trash-empty"  onclick="del('<?php echo $t; ?>')"></i></a>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/fancybox/jquery.fancybox-1.3.4.css" />
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/fancybox/jquery.fancybox-1.3.4.js"></script>
<script>
    var templatesize = <?php echo sizeof ( $templates ); ?>;
    function setDefault(template){
        $.get('index.php?r=admin/template/setDefault',{template:template},function(res){
            if(res==1){
                success("默认模板设置成功！")
            }
        });
    }
    function del(template){
        if(templatesize==1){
            alert('至少保留一个模板！');
        }else{
            confirm(function(){
                $.get('index.php?r=admin/template/delTemplate',{template:template},function(res){
                    if(res == 1){
                        window.location.reload();
                    }
                });
            },'确定删除模板？')
        }
    }
    function showedit(template){
        window.location.href="index.php?r=admin/template/showedit&template="+template;
    }
</script>