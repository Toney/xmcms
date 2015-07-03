<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>优化推广</span><span><i class="icon-angle-double-right"></i>伪静态</span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <form name="form_edit" id="form_edit" action="index.php?r=admin/rewrite/edit" method="post">
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1">伪静态环境监测</td>
                    <td>
                        <?php
                        $result = apache_get_modules();
                        if (in_array('mod_rewrite', $result)) {
                            echo '<i class="green icon-ok"></i>';
                        } else {
                            echo '<i class="red icon-cancel"></i>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="col1">开启伪静态</td>
                    <td>
                        <input name="isrewrite" type="radio" value="1"/>是&nbsp;&nbsp;
                        <input name="isrewrite" type="radio" value="0"/>否
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" class="ui-button ui-widget ui-state-default " value="保存"/></td>
                </tr>
            </table>
        </form>
    </div>
</div>