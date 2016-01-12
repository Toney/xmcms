<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>语言管理</span><span><i class="icon-angle-double-right"></i>语言列表</span>
</div>

<div class="grid_12 bar">
    <div class="ui-buttonset mgl_10">
        <input type="button" class="ui-button ui-widget ui-state-active" value="网站语言" />
        <input type="button" class="ui-button ui-widget ui-state-default" value="后台语言" onclick="window.location.href='index.php?r=admin/language/back'" />
    </div>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th>语言名称</th>
                <th class="w_40">标记</th>
                <th class="w_40">开启</th>
                <th class="w_40">默认</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(sizeof($langs)>0){
                foreach ( $langs as $l ) {
                    ?>
                    <tr>
                        <td><?php echo $l['name']; ?></td>
                        <td><img src="<?php echo $l['flag'];?>" /></td>
                        <td><?php echo $l['useok']==1?"<i class=\"green icon-ok\"></i>":"<i class=\"red icon-cancel\"></i>"; ?></td>
                        <td><?php echo $l['isdefault']==1?"<i class=\"green icon-ok\"></i>":"<i class=\"red icon-cancel\"></i>"; ?></td>
                        <td class="w80">
                            <a><i class="icon-edit" title="编辑" onclick="showedit(<?php echo $l['id']; ?>)" ></i></a>
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
<script>
    function showedit(id){
        window.location.href="index.php?r=admin/language/showedit&id="+id;
    }
</script>