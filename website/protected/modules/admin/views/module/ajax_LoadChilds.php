<?php
if(sizeof($childs)>0){
    foreach($childs as $m){
        ?>
        <tr parentid="<?php echo $m['parentid']; ?>" class="<?php echo $m['childcounts']>0?"haschild":""; ?> tr_<?php echo $m['module_id']; ?>" id="<?php echo $m['module_id']; ?>">
            <td><input type="text" class="ui w30" name="seq" value="<?php echo $m['seq']; ?>" /></td>
            <td><?php echo $m['childcounts']>0?"<img class='mgl_5 columnx' src='css/admin/img/bg_columnx.gif'/><img class='mgr_5' src='css/admin/img/colum1nx2.gif'/>":"<img class='columnx' src='css/admin/img/bg_column.gif'/>"; ?>
                <input type="text" class="ui w200" value="<?php echo $m['category']; ?>" name="category" />
            </td>
            <td><select name="ishid" class="ui">
                    <?php
                    if($m['ishid']==0){
                        ?>
                        <option selected="selected" value="0">是</option>
                        <option value="1">否</option>
                    <?php
                    }else{
                        ?>
                        <option value="0">是</option>
                        <option selected="selected" value="1">否</option>
                    <?php
                    }
                    ?>
                </select></td>
            <td><?php echo $this->getModuleName($m['module']); ?></td>
            <td><?php echo $m['module_id']; ?></td>
            <td><?php echo $m['module']=='link'?$m['url']:$m['module']; ?></td>
            <td><a><i class="icon-doc" title="新建" onclick="addThird(<?php echo $m['module_id']; ?>)" ></i></a>
                <a><i class="icon-edit" title="编辑" onclick="showedit(<?php echo $m['module_id']; ?>)" ></i></a>
                <a><i class="icon-trash-empty" title="删除" onclick="del(<?php echo $m['module_id']; ?>)"></i></a></td>
        </tr>
        <?php
        if(sizeof($m['childs'])>0){
            foreach($m['childs'] as $c){
            ?>
                <tr parentid="<?php echo $c['parentid']; ?>" class="<?php echo $c['childcounts']>0?"haschild":""; ?> tr_<?php echo $c['module_id']; ?>" id="<?php echo $c['module_id']; ?>">
                    <td><input type="text" class="ui w30" name="seq" value="<?php echo $c['seq']; ?>" /></td>
                    <td><img class='columnx mgl_20 mgr_5' src='css/admin/img/bg_column1.gif'/>
                        <input type="text" class="ui w200" value="<?php echo $c['category']; ?>" name="category" />
                    </td>
                    <td>
                        <select name="ishid" class="ui">
                            <?php
                            if($c['ishid']==0){
                                ?>
                                <option selected="selected">是</option>
                                <option>否</option>
                            <?php
                            }else{
                                ?>
                                <option >是</option>
                                <option selected="selected">否</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td><?php echo $this->getModuleName($c['module']); ?></td>
                    <td><?php echo $m['module_id']; ?></td>
                    <td><?php echo $c['module']=='link'?$c['url']:$c['module']; ?></td>
                    <td>
                        <a><i class="icon-edit" title="编辑" onclick="showedit(<?php echo $c['module_id']; ?>)" ></i></a>
                        <a><i class="icon-trash-empty" title="删除" onclick="del(<?php echo $c['module_id']; ?>)"></i></a>
                    </td>
                </tr>
            <?php
            }
        }
    }
}
