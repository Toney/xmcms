<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>查看反馈</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th>内容</th>
                <th class="w_40">已读</th>
                <th class="w160">提交时间</th>
                <th class="w80">模块</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(sizeof($list)>0){
                foreach ( $list as $f ) {
                    ?>
                    <tr>
                        <td><?php echo csubstr($f['content'],0,50,"utf-8",false); ?></td>
                        <td><?php
                            if($f['haveread']==0){
                                echo "<span class='red'>否</span>";
                            }else{
                                echo "是";
                            }
                            ?></td>
                        <td><?php echo $f['createtime']; ?></td>
                        <td><?php echo $f->module->category;?></td>
                        <td  class="w80">
                            <a><i class="icon-docs" title="查看" onclick="view(<?php echo $f['feedback_id']; ?>)" ></i></a>
                            <a><i class="icon-trash-empty" title="删除" onclick="del(<?php echo $f['feedback_id']; ?>)"></i></a>
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
    function view(id){
        window.location.href="index.php?r=admin/feedback/view&id="+id;
    }
    function del(id){
        confirm(function(){
            $.get('index.php?r=admin/feedback/del&id='+id,null,function(result){
                if(result.type == true){
                    window.location.reload();
                }else{
                    alert(result.message);
                }
            },'json');
        },'确定删除回复');
    }
</script>