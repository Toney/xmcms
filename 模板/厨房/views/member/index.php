<div class="container_12 mgb">
    <div class="grid_12" >
        <div class="crumb"><a href="<?php echo Yii::app()->theme->baseUrl; ?>"><i class="icon-home"></i>首页</a>
            <i class="icon-double-angle-right"></i>用户中心
        </div>
    </div>
</div>

<div class="container_12 mgb">
    <div class="grid_9 bg_white" >
        <div class="p20">
            <div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" >
                    <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" >
                        <a  class="ui-tabs-anchor"  >基本信息</a>
                    </li>
                </ul>
                <?php
                $user = Yii::app()->session['user'];
                ?>
                <div class="ui-tabs-panel ui-widget-content ui-corner-bottom">
                    <table class="form">
                        <tr>
                            <td class="col1">用户名</td>
                            <td><?php echo $user['username']; ?></td>
                        </tr>
                        <tr>
                            <td class="col1">会员类型</td>
                            <td><?php echo $user['isadmin']==1?"管理员":$group['groupname']; ?></td>
                        </tr>
                        <tr>
                            <td class="col1">登入次数</td>
                            <td><?php echo $user['login_num']; ?></td>
                        </tr>
                        <tr>
                            <td class="col1">最后登入时间</td>
                            <td><?php echo $user['last_logintime']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="grid_3 " >
        <?php
        $this->renderFile(Yii::app()->theme->viewPath.'/include/usertools.php');
        ?>
    </div>
</div>

