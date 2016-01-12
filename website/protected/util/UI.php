<?php
/**
 *
 * 展开模块列表，多级导航
 *
 * @param $modules 模块列表
 */
function ui_navbar($modules,$active){
    if(sizeof($modules)>0){
        foreach($modules as $m){
            ui_navbar_item($m,1,$active);
        }
    }
}
function ui_navbar_item($m,$lv,$active){
    $isactive = $active == $m['module_id']?"active":"";
    if(sizeof($m['childs'])>0){
        if($lv == 1){
            ?>
            <li class="dropdown <?=$isactive ?>">
            <?php
        }else{
            ?>
            <li class="dropdown-submenu <?=$isactive ?>">
            <?php
        }

        if($lv == 1){
            ?>
            <a href="index.php/<?php echo $m['module']; ?>/index/id/<?php echo $m['module_id']; ?>" class="dropdown-toggle" data-toggle="dropdown" ><?php echo $m['category']; ?><span class="caret"></span></a>
            <?php
        }else{
            ?>
            <a href="index.php/<?php echo $m['module']; ?>/index/id/<?php echo $m['module_id']; ?>" ><?php echo $m['category']; ?></a>
        <?php
        }

        ?>
            <ul class="dropdown-menu">
                <?php
                foreach($m['childs'] as $c){
                    ui_navbar_item($c,2,$active);
                }
                ?>
            </ul>
        </li>
        <li class="divider"></li>
    <?
    }else{
        ?>
        <li <?=$isactive ?> ><a href="index.php/<?php echo $m['module']; ?>/index/id/<?php echo $m['module_id']; ?>"><?php echo $m['category']; ?></a></li>
        <li class="divider"></li>
    <?php
    }
}

