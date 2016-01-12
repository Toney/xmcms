<?php
if(!(sizeof($this->data['modulequeue'])==1 && empty($this->data['modulequeue'][0]['childs']) )){
    ?>
    <div class="box bg_white mgb">
        <?php
        if(sizeof($this->data['modulequeue'])>0){
            foreach($this->data['modulequeue'] as $module){
                ?>
                <div class="head ui-widget-header "><a href="<?php echo $module['module']=='link'?$module['url']:$this->getUrl($module['module'],"index",Array('id'=>$module['module_id'])); ?>"><?php echo $module['category']; ?></a></div>
                <?php
                if(sizeof($module['childs'])>0){
                    ?>
                    <div class="itemlist plr">
                        <ul>
                            <?php
                            foreach($module['childs'] as $c){
                                ?>
                                <li class="<?php echo $this->data['cur_moduleid']==$c['module_id']?"current":""; ?>"><a href="<?php echo $c['module']=='link'?$c['url']:$this->getUrl($c['module'],"index",Array('id'=>$c['module_id'])); ?>"><?php echo $c['category']; ?></a></li>
                                <?php
                                if(sizeof($c['childs'])>0){
                                    foreach($c['childs'] as $i){
                                        ?>
                                        <li class="twoem <?php echo $this->data['cur_moduleid']==$i['module_id']?"current":""; ?>"><a href="<?php echo $i['module']=='link'?$i['url']:$this->getUrl($i['module'],"index",Array('id'=>$i['module_id'])); ?>"><?php echo $i['category']; ?></a></li>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
            }
        }
        ?>
    </div>
    <?php

}
?>



