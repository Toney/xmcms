<div data-role="page">

    <div data-role="header" style="overflow:hidden;">
        <a href="index.php?r=wap/default/index" class="ui-btn ui-shadow ui-corner-all ui-icon-home ui-btn-icon-notext">首页</a>
        <h1><?php echo $APPCONFIG['webname']; ?></h1>
        <a href="index.php?r=wap/module/index" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">分类</a>
    </div><!-- /header -->

    <div role="main" class="ui-content">
        <div class="ui-grid-c">
            <?php
            $i=4;
            $abcd = "";
            foreach($modules as $m){
                if($i%4==0){
                    $abcd = "a";
                }else if($i%3==0){
                    $abcd = "b";
                }else if($i%2==0){
                    $abcd = "c";
                }else{
                    $abcd = "d";
                }
                ?>
                <div class="ui-block-<?php echo $abcd; ?>"><input type="button" onclick="window.location.href='index.php?r=wap/<?php echo $m['module']; ?>/index&module_id=<?php echo $m['module_id']; ?>'" value="<?php echo $m['category']; ?>" /></div>
                <?php
                $i++;
            }
            ?>

        </div>
    </div>

</div>