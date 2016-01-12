<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>查看留言</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th class="w80">作者</th>
                <th>标题</th>
                <th>内容</th>
                <th class="w_40">已读</th>
                <th class="w80">模块</th>
                <th class="w160">提交时间</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(sizeof($list)>0){
                foreach ( $list as $m ) {
                    ?>
                    <tr>
                        <td class="w_40"><?php echo $m->user->username;?></td>
                        <td><?php echo $m['title']; ?></td>
                        <td><?php echo $m['content']; ?></td>
                        <td class="w_40"><?php
                            if($m['haveread']==0){
                                echo "否";
                            }else{
                                echo "是";
                            }
                            ?></td>

                        <td class="w80"><?php echo $m->module->category; ?></td>
                        <td class="w80"><?php echo $m['createtime'];?></td>
                        <td class="w80">
                            <a><i class="icon-edit" title="编辑" onclick="showedit(<?php echo $m['message_id']; ?>)" ></i></a>
                            <a><i class="icon-trash-empty" title="删除" onclick="del(<?php echo $m['message_id']; ?>)"></i></a>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>
        <div id="pager">

            <?php
            $this->widget('CLinkPager',array(
                    'header'=>'',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '末页',
                    'prevPageLabel' => '上一页',
                    'nextPageLabel' => '下一页',
                    'pages' => $pages,
                )
            );
            ?>

        </div>
    </div>
</div>

<script>

    function showedit(id){
        window.location.href="index.php?r=admin/message/showedit&id="+id;
    }
    function del(id){
        confirm(function(){
            $.get('index.php?r=admin/message/del',{id:id},function(result){
                if(result.type == true){
                    window.location.reload();
                }else{
                    alert(result.message);
                }
            },'json');
        },'是否删除消息？')
    }
    /*function delCked(){
        confirm(function(){
            var cks = $("input[name=ck]").val();
            if(cks.length>0){
                var ids = Array();
                for(var i=0;i<cks.length;i++){
                    ids.push(cks[i]);
                }
                $.post('dels',{ids:ids.toString()},function(res){
                    if(res == 1){
                        window.location.reload();
                    }
                });
            }else{
                alert("请选择文章信息");
            }
        },'确定删除文章信息？');
    }*/
</script>