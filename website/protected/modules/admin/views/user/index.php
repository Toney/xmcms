<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>用户管理</span><span><i class="icon-angle-double-right"></i>用户列表</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <div class="toolbar">
            <span class="fr"><input type="button" value="添加" class="ui-button ui-widget ui-state-default " onclick="showedit(0)"></span>
            <span class="fl"><input type="text" class="ui" />&nbsp;&nbsp;<input type="button" value="查询" class="ui-button ui-widget ui-state-default " ></span>
        </div>

        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th class="tal">登入名</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>电话</th>
                <th>手机</th>
                <th>有效</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(sizeof($list)>0){
                foreach ( $list as $u ) {
                    ?>
                    <tr>
                        <td><?php echo $u['loginname'];?></td>
                        <td><?php echo $u['username'];?></td>
                        <td><?php echo $u['email'];?></td>
                        <td><?php echo $u['tel'];?></td>
                        <td><?php echo $u['phone'];?></td>
                        <td><?php echo $u['isvalid']==1?"<i class=\"icon-ok green\"></i>":"<i class=\"icon-cancel red\"></i>";?></td>
                        <td>
                            <a onclick="showedit(<?php echo $u['user_id']; ?>)"><i class="icon-edit"></i></a>
                            <a onclick="del(<?php echo $u['user_id']; ?>)"><i class="icon-trash-empty"></i></a>
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
                    'pages' => $pages
                )
            );
            ?>

        </div>
    </div>
</div>

<script>
    function showedit(id){
        if(id==0){
            window.location.href="index.php?r=admin/user/add&id="+id;
            return;
        }
        window.location.href="index.php?r=admin/user/showedit&id="+id;
    }
    function del(id){
        confirm(function(){
            $.get('index.php?r=admin/user/del',{id:id},function(result){
                if(result.type == true){
                    window.location.reload();
                }else{
                    alert(result.message);
                }
            },'json');
        },'是否删除用户？')
    }
</script>