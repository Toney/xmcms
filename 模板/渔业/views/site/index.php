<div class="container_12 mgb">
    <div class="grid_12" style="">
        <div class="banner">
            <ul>
                <li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/img/banner_img1.png"/></li>
                <li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/img/banner_img2.png"/></li>
                <li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/img/banner_img3.png"/></li>
            </ul>
        </div>
        <style>
            .banner {
                position: relative;
                overflow: auto;
            }

            .banner li {
                list-style: none;
            }

            .banner ul li {
                float: left;
            }
        </style>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ui/external/unslider/unslider.min.js"></script>
        <script>
            $(function () {
                $('.banner').unslider({
                    speed: 1000,               //  The speed to animate each slide (in milliseconds)
                    delay: 3000,              //  The delay between slide animations (in milliseconds), false for no autoplay
                    complete: function () {
                    },  //  A function that gets called after every slide animation
                    keys: true,               //  Enable keyboard (left, right) arrow shortcuts
                    dots: true,               //  Display dot navigation
                    fluid: false              //  Support responsive design. May break non-responsive designs
                });
            });
        </script>
    </div>
</div>

<!--关于我们/产品展示-->
<div class="container_12 "  >
    <div class="grid_8 mgb bg_white" style="min-height: 370px;" >
        <div class="p20"   >
            <?php
            echo $FRAGMENT['aboutus'];
            ?>
        </div>
    </div>
    <div class="grid_4 mgb bg_white"  style="min-height: 370px;">
        <div class="box " >
            <div class="head ui-widget-header "><i class="icon-flag"></i>&nbsp;&nbsp;新闻中心
                <span class="fr"><a href="<?php echo $this->getUrl('article',"index",Array(id=>50)); ?>"><i class="icon-double-angle-right"></i></a></span>
            </div>

            <div class="itemlist plr">
                <ul>
                    <?php
                    foreach($articles as $article){
                        ?>
                        <li><a href="<?php echo $this->getUrl($article['infotype'],"view",Array(id=>$article['article_id'])); ?>">
                                <?php echo csubstr($article['title'],0,30,'utf-8',true); ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<!--案例展示-->
<div class="container_12" id="case" style="height:550px;">

    <?php
    foreach($products as $product){
        ?>
        <div class="grid_3 mgb" >
            <div class="caseitem">
                <img style="display: block;" width="100%" height="100%" src="<?php echo $product['image'] ?>" />
                <div class="captain"><a href="<?php echo $this->getUrl('product',"view",Array(id=>$product['article_id'])); ?>" ><?php echo $product['title'] ?></a></div>
            </div>
        </div>
        <?php
    }
    ?>

</div>



<style>
    .banner {
        position: relative;
        width: 100%;
        overflow: auto;
        height: 320px !important;

        font-size: 18px;
        line-height: 24px;
        text-align: center;

        color: rgba(255,255,255,.6);
        text-shadow: 0 0 1px rgba(0,0,0,.05), 0 1px 2px rgba(0,0,0,.3);
        box-shadow: 0 1px 2px rgba(0,0,0,.25);
    }
    .banner ul {
        list-style: none;
        width: 300%;
    }
    .banner ul li {
        display: block;
        float: left;
        width: 33%;
        min-height: 320px;

        -o-background-size: 100% 100%;
        -ms-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -webkit-background-size: 100% 100%;
        background-size: 100% 100%;

        box-shadow: inset 0 -3px 6px rgba(0,0,0,.1);
    }

    .banner .inner {
        padding: 160px 0 110px;
    }

    .banner h1, .banner h2 {
        font-size: 40px;
        line-height: 52px;

        color: #fff;
    }

    .banner .btn {
        display: inline-block;
        margin: 25px 0 0;
        padding: 9px 22px 7px;
        clear: both;

        color: #fff;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;

        border: 2px solid rgba(255,255,255,.4);
        border-radius: 5px;
    }
    .banner .btn:hover {
        background: rgba(255,255,255,.05);
    }
    .banner .btn:active {
        -webkit-filter: drop-shadow(0 -1px 2px rgba(0,0,0,.5));
        -moz-filter: drop-shadow(0 -1px 2px rgba(0,0,0,.5));
        -ms-filter: drop-shadow(0 -1px 2px rgba(0,0,0,.5));
        -o-filter: drop-shadow(0 -1px 2px rgba(0,0,0,.5));
        filter: drop-shadow(0 -1px 2px rgba(0,0,0,.5));
    }

    .banner .btn, .banner .dot {
        -webkit-filter: drop-shadow(0 1px 2px rgba(0,0,0,.3));
        -moz-filter: drop-shadow(0 1px 2px rgba(0,0,0,.3));
        -ms-filter: drop-shadow(0 1px 2px rgba(0,0,0,.3));
        -o-filter: drop-shadow(0 1px 2px rgba(0,0,0,.3));
        filter: drop-shadow(0 1px 2px rgba(0,0,0,.3));
    }

    .banner .dots {
        position: absolute;
        left:-40px;
        right: 0;
        bottom: 10px;
        /*width: 100%;*/
    }
    .banner .dots li {
        display: inline-block;
        *display: inline;
        zoom: 1;

        width: 10px;
        height: 10px;
        line-height: 10px;
        /*margin: 0 4px;*/
        margin: 0 4px;

        text-indent: -999em;
        *text-indent: 0;

        border: 2px solid #fff;
        border-radius: 6px;

        cursor: pointer;
        opacity: .4;

        -webkit-transition: background .5s, opacity .5s;
        -moz-transition: background .5s, opacity .5s;
        transition: background .5s, opacity .5s;
    }
    .banner .dots li.active {
        background: #fff;
        opacity: 1;
    }

    .banner .arrows {
        position: absolute;
        bottom: 20px;
        right: 20px;
        color: #fff;
    }
    .banner .arrow {
        display: inline;
        padding-left: 10px;
        cursor: pointer;
    }
</style>
