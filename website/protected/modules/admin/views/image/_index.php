<div id="content">
    <div class="box">
        <div class="title">
            <h5>内容管理>图片管理</h5>
        </div>
        <?php
        if($this->actExist('Add,Del')){
            ?>
            <div class="viewbar tar ptr10">
                <?php
                $this->actPermission('<button class="btn" onclick="showedit(0)">添加</button>',"Add");
                $this->actPermission('<button class="btn" onclick="delCked()">删除</button>','Del');
                ?>

            </div>
        <?php
        }
        ?>
        <form action="index" name="form_view">
            <input type="hidden" name="current"/>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th class="tac" style="width: 25px;" ><input type="checkbox" name="checkall" onclick="triggerCK()"/></th>
                        <th class="tal">标题</th>
                        <th>排序</th>
                        <th>更新时间</th>
                        <th>模块</th>
                        <?php
                        if($this->actExist('Edit,Del')){
                            ?>
                            <th class="last" style="width: 150px;">工具</th>
                        <?php
                        }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(sizeof($images)>0){
                        foreach ( $images as $i ) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="ck" value="<?php echo $i['image_id']; ?>" /></td>
                                <td class="tal"><?php echo $i['title'];?></td>
                                <td class="tac"><?php echo $i['orderby'];?></td>
                                <td class="tac"><?php echo $i['createtime'];?></td>
                                <td class="tac"><?php echo $i['category'];?></td>
                                <?php
                                if($this->actExist('Edit,Del')){
                                    ?>
                                    <td class="tac">
                                        <?php
                                        $imgid = $i['image_id'];
                                        $this->actPermission('<button class="btn" onclick="showedit('.$imgid.')">编辑</button>','Edit');
                                        $this->actPermission('<button class="btn" onclick="del('.$imgid.')">删除</button>','Del');
                                        ?>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <?php echo $pagebar->buildBar();?>
            </div>
        </form>
    </div>
</div>
<script>
    var current = <?php echo $pagebar->current;?>;
    function showedit(id){
        window.location.href="showedit?id="+id+"&current="+current;
    }
    function del(id){
        confirm(function(){
            window.location.href="del?id="+id+"&current="+current;
        },'是否删除图片？')
    }
    function delCked(){
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
                alert("请选择图片");
            }
        },'确定删除图片？');
    }
</script>