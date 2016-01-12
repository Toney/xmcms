<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>内容管理</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <div class="toolbar">
            <span class="fl">
                <select class="ui" name="type" onchange="changeType()">
                    <option value="article" <?php echo $type=='article'?"selected='selected'":"" ?> >文章</option>
                    <option value="download" <?php echo $type=='download'?"selected='selected'":"" ?> >下载</option>
                    <option value="job" <?php echo $type=='job'?"selected='selected'":"" ?>  >招聘</option>
                    <option value="image" <?php echo $type=='image'?"selected='selected'":"" ?> >图片</option>
                    <option value="product" <?php echo $type=='product'?"selected='selected'":"" ?> >产品</option>
                </select>
            </span>
            <span class="fr"><input type="button" class="ui-button ui-widget ui-state-default " value="新建"
                                    onclick="showedit(0)"/></span>
        </div>

        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th class="w10"><input type="checkbox" name="ckall" onclick="triggerCK()" ></th>
                <th class="w30">排序</th>
                <th>标题</th>
                <th class="w80">栏目</th>
                <th class="w30">推荐</th>
                <th class="w30">置顶</th>
                <th class="w80">更新时间</th>
                <th class="w80">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($list) > 0) {
                foreach ($list as $l) {
                    ?>
                    <tr>
                        <td class="w10"><input type="checkbox" name="ck" value="<?php echo $l['article_id']; ?>"/></td>
                        <td class="w30"><?php echo $l['seq']; ?></td>
                        <td><?php echo $l['title']; ?></td>
                        <td class="w80"><?php echo $l->module->category; ?></td>
                        <td class="w30"><?php echo $l['recommend']==0?"否":"是"; ?></td>
                        <td class="w30"><?php echo $l['top']==0?"否":"是"; ?></td>
                        <td class="w80"><?php echo $l['createtime']; ?></td>
                        <td class="w80">
                            <a><i class="icon-edit" title="编辑" onclick="showedit(<?php echo $l['article_id']; ?>)" ></i></a>
                            <a><i class="icon-trash-empty" title="删除" onclick="del(<?php echo $l['article_id']; ?>)"></i></a>
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
            $this->widget('CLinkPager', array(
                    'header' => '',
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
        var type = $("select[name=type]").val();
        if(id==0){
            window.location.href="index.php?r=admin/"+type+"/add&id="+id;
            return;
        }
        window.location.href="index.php?r=admin/"+type+"/showedit&id="+id;
    }
    function del(id){
        confirm(function(){
            var type = $("select[name=type]").val();
            $.get('index.php?r=admin/'+type+'/del',{id:id},function(result){

                if(result.type == true){
                    window.location.reload();
                }else{
                    alert(result.message);
                }
            },'json');
        },"确定删除内容？");
    }
    function changeType(){
        var type = $("select[name=type]").val();
        window.location.href="index.php?r=admin/content/index&type="+type;
    }
</script>