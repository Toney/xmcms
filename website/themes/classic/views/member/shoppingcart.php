<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>购物车
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <div class="box bdnone">
                <form id="form_edit" action="index.php?r=member/commitorder"  method="post">
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <div class="itemlist ">
                    <ul>
                        <?php
                        if(sizeof($shopingcartlist)>0){
                            foreach($shopingcartlist as $l){
                                ?>
                                <li class="itembb">
                                    <div class="content">
                                        <input type="hidden" value="<?php echo $l['article_id']; ?>" name="articleid_<?php echo $l['shopcart_id']; ?>" />
                                        <table class="wp100">
                                            <tr>
                                                <td style="width: 41%;" >
                                                    <div class="caseitem" >
                                                        <img style="display: block;" width="100%" height="260px" src="<?php echo $l->image->image; ?>" />
                                                        <div class="captain"><a href="<?php echo $this->getUrl('image',"view",Array(id=>$l['article_id'])); ?>" ><?php echo $l['title'] ?></a></div>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: top;" class="pdl">
                                                    <div class="lh30">
                                                        <span class="fl"><h2><a href="<?php echo $this->getUrl('image',"view",Array(id=>$l['article_id'])); ?>" ><?php echo csubstr(strip_tags($l['title'] ),0,25,'utf-8',true);  ?></a></h2></span>
                                                        <span class="fr"><input type="checkbox" name="shopcart_id[]" value="<?php echo $l['shopcart_id']; ?>"></span>
                                                    </div>
                                                    <p class="info art_content">
                                                        <?php echo csubstr(strip_tags($l['description'] ),0,220,'utf-8',true);  ?>
                                                    </p>
                                                    <div class="buyitem"><span class="fl">价格：<?php echo $l['price']; ?></span>
                                                        <span class="fr">数量：<input name="num_<?php echo $l['shopcart_id']; ?>" class="small  validate[required,custom[integer]]" value="<?php echo $l['num']; ?>" /></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                            <li>
                                <div class="lh30">
                                <span class="fr">
                                    <input type="button" class="ui-state-default ui" onclick="save()" value="生成订单"/>
                                </span>
                                </div>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li>
                                <div class="tac">
                                    <i class="icon-shopping-cart icon-4x " style="color: #0096c9;" ></i><br>
                                    购物车还是空的，先去添加商品吧！:-D
                                </div>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>

</div>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/css/validationEngine.jquery.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
</script>