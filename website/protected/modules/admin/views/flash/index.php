<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>界面设置</span><span><i class="icon-angle-double-right"></i>FLASH设置</span>
</div>
<div class="grid_12 container">
    <div class="container_in">

        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th class="tal">标题</th>
                <th class="w_60">类型</th>
                <th class="w_60">键</th>
                <th class="last w80" >工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof ( $flashs ) > 0) {
                foreach($flashs as $f){
                    ?>
                    <tr>
                        <td class="tal"><?php echo $f['title'];?></td>
                        <td class="tac"><?php echo $f['flashtype']=='images'?"图片":"FLASH";?></td>
                        <td class="tac"><?php echo $f['name'];?></td>
                        <td>
                            <a><i class="icon-edit" onclick="showedit(<?php echo $f['flash_id']; ?>)" ></i></a>
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
    function showedit(fid){
        window.location.href="index.php?r=admin/flash/showedit&flash_id="+fid;
    }
</script>