<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>用户管理</span><span><i class="icon-angle-double-right"></i>用户组管理</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <div class="toolbar" >
            <span class="fr"><input type="button" value="添加" class="ui-button ui-widget ui-state-default " onclick="showedit(0)"></span>
        </div>

        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th >组名</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof ( $groups ) > 0) {
                foreach($groups as $g){
                    ?>
                    <tr>
                        <td><?php echo $g['groupname'];?></td>
                        <td><a onclick="showedit(<?php echo $g['id']; ?>)"><i class="icon-edit"></i></a>
                            <a onclick="del(<?php echo $g['id']; ?>)"><i class="icon-trash-empty"></i></a></td>
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
    if(id==0){
        window.location.href="index.php?r=admin/group/add&id="+id;
        return;
    }
    window.location.href="index.php?r=admin/group/showedit&id="+id;
}
function del(id){
    confirm(function(){
        $.get('index.php?r=admin/group/del',{id:id},function(result){
            if(result.type == true){
                window.location.reload();
            }else{
                alert(result.message);
            }
        },'json');
    },'确定删除会员组？')
}
</script>