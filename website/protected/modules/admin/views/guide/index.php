<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>内容管理</span><span><i class="icon-angle-double-right"></i>基本内容管理</span>
</div>
<div class="grid_12 container">
    <div class="container_in">
        <table class="list">
            <thead>
            <tr>
                <th class="tal">标题</th>
                <th class="last" style="width:150px;">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof ( $guides ) > 0) {
                foreach($guides as $g){
                    ?>
                    <tr>
                        <td class="tal"><?php echo $g['category'];?></td>
                        <td class="last tac">
                            <input type="button" value="编辑" class="btn_small ui-button ui-widget ui-state-default ui-corner-all" onclick="showedit(<?php echo $g['module_id']; ?>)" />
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
    window.location.href="showedit?id="+id;
}
</script>