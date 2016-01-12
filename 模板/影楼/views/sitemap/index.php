<?php
require Yii::app()->theme->viewPath.'/include/doctype.php';
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $config_basic['webname']['content'];?></title>
    <meta name="Description" content=" add description  ... "/>
    <meta name="Keywords" content=" add keywords     ... "/>
    <?php
    require Yii::app()->theme->viewPath.'/include/htmlheader.php';
    ?>
<head>
<body>
<div id="wrap">

    <?php
    require Yii::app()->theme->viewPath.'/include/header.php';
    ?>

    <div id="content" class="fixed">
        <div id="page-header"><img src="<?php echo $flashs['item_bar'][0]['imageurl']; ?>" width="880" height="180" alt=""/>
            <div id="page-header-title"><?php echo $flashs['item_bar'][0]['title']; ?></div>
        </div>
        <div class="fixed">
            <div class="col580">
                <ul class="accordion fixed" id="accordion-1">
                    <li><a href="#accordion-1-slide-1">Accordeon Slide 1</a>

                        <div style="display: none;"><p>Phasellus egestas accumsan laoreet. Phasellus tincidunt ipsum sit
                                amet urna egestas rhoncus. Etiam quis lacus a nulla lacinia lobortis ut nec orci. Morbi
                                in metus non tellus viverra convallis quis sit amet lacus.</p></div>
                    </li>
                    <li><a href="#accordion-1-slide-2">Accordeon Slide 2</a>
                        <div style="display: block;"><p>Vivamus in nibh cursus ipsum condimentum imperdiet. Mauris in
                                magna sed felis ornare rhoncus. Etiam ac mi id leo tincidunt gravida sit amet vel erat.
                                Fusce in magna neque. Vestibulum dignissim diam non arcu vehicula scelerisque ornare
                                felis pellentesque. Mauris ac metus arcu.</p></div>
                    </li>
                </ul>
            </div>
            <div class="col280 last">
                <p><?php
                    echo $other['contact_content']['description'];
                    ?></p>

                <div class="pdf"><a href="#"><?php echo Yii::t('front', 'downloadour'); ?>
                        <br/><?php echo Yii::t('front', 'detailedServiceBrochure'); ?></a></div>
            </div>
        </div>
    </div>

    <?php
    require Yii::app()->theme->viewPath.'/include/footer.php';
    ?>

</div>
</body>
</html>