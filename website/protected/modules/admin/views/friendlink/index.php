<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>优化推广</span><span><i class="icon-angle-double-right"></i>友情链接</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <table class="list">
            <thead class="ui-widget-header">
                <tr>
                    <th>网站名称</th>
                    <th>地址</th>
                    <th>Logo地址</th>
                    <th>关键字</th>
                    <th class="w_40">排序</th>
                    <th class="w_40">已审核</th>
                    <th class="w_40">已读</th>
                    <th class="w_40">类型</th>
                    <th class="w80">工具</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(sizeof($friendlinks)>0){
                foreach ( $friendlinks as $f ) {
                    ?>
                    <tr>
                        <td><?php echo $f['webname'];?></td>
                        <td><?php echo $f['weburl']; ?></td>
                        <td><?php echo $f['logourl'];?></td>
                        <td><?php echo $f['keyword'];?></td>
                        <td><?php echo $f['seq'];?></td>
                        <td><?php echo $f['isauth']==0?"<span class='red'>否</span>":"是";?></td>
                        <td>
                            <?php echo $f['haveread']==0?"<span class='red'>否</span>":"是";?>
                        </td>
                        <td><?php echo $f['linktype']==1?"文字":"图片";?></td>
                        <td>
                            <a><i class="icon-edit" title="编辑" onclick="showedit(<?php echo $f['friendlink_id']; ?>)" ></i></a>
                            <a><i class="icon-trash-empty" title="删除" onclick="del(<?php echo $f['friendlink_id']; ?>)"></i></a>
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
        window.location.href="index.php?r=admin/friendlink/showedit&id="+id;
    }
    function del(id){
        confirm(function(){
            $.get('index.php?r=admin/friendlink/del&id='+id,null,function(result){
                if(result.type == true){
                    window.location.reload();
                }else{
                    alert(result.message);
                }
            },'json');
        },'是否删除该友情链接？')
    }
</script>