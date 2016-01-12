<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>内容管理</span><span><i class="icon-angle-double-right"></i>片段管理</span>
</div>
<div class="grid_12 container">
    <div class="container_in">

        <div class="toolbar">
            <span class="fr">
                <input type="button" class="ui-button ui-widget ui-state-default " value="新建" onclick="showedit(0)"/>
            </span>
        </div>

        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th>标题</th>
                <th class="w80">关键值</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($fragments) > 0) {
                foreach ($fragments as $i) {
                    ?>
                    <tr>
                        <td><?php echo $i['title']; ?></td>
                        <td class="w80"><?php echo $i['key']; ?></td>
                        <td class="w80">
                            <a><i class="icon-edit" title="编辑" onclick="showedit(<?php echo $i['id']; ?>)" ></i></a>
                            <a><i class="icon-trash-empty" title="删除" onclick="del(<?php echo $i['id']; ?>)"></i></a>
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
    function showedit(id) {
        if(id==0){
            window.location.href = "index.php?r=admin/fragment/add&id=" + id;
            return;
        }
        window.location.href = "index.php?r=admin/fragment/showedit&id=" + id;
    }
    function del(id) {
        confirm(function () {
            $.get('index.php?r=admin/fragment/del',{id:id},function(result){
                if(result.type == true){
                    window.location.reload();
                }else{
                    alert(result.message);
                }
            },'json');
        }, '是否删除片段？')
    }

</script>