<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/css/validationEngine.jquery.css" />
<div id="content">
    <div id="left">
        <?php
        $this->widget ( 'application.modules.manage.widgets.ViewWidgets', array (
            'view' => 'nav_seo'
        ) );
        ?>
    </div>
    <div id="right">
        <div class="box">
            <div class="title">
                <h5>优化推广>友情链接</h5>
            </div>
            <div class="viewbar tar ptr10">
                <button class="btn" onclick="save()">保存</button>
            </div>

            <div class="form" >
                <form name="form_edit" id="form_edit" action="edit" method="post" >
                    <input type="hidden" name="friendlink_id" value="<?php echo $id; ?>" />
                    <table class="form">
                        <tr>
                            <td class="label">链接类型</td>
                            <td>
                                <?php
                                if($friendlink['linktype']==1){
                                    ?>
                                    <input type="radio" name="linktype" value="1" checked="checked"/>文字&nbsp;&nbsp;
                                    <input type="radio" name="linktype" value="2"/>图片
                                    <?php
                                }else{
                                    ?>
                                    <input type="radio" name="linktype" value="1"/>文字&nbsp;&nbsp;
                                    <input type="radio" name="linktype" value="2" checked="checked"/>图片
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">网站名称</td>
                            <td>
                                <input type="text" name="webname" value="<?php echo $friendlink['webname']; ?>" class="small"/>&nbsp;&nbsp;<span class="red">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">地址</td>
                            <td>
                                <input type="text" name="weburl" value="<?php echo $friendlink['weburl']; ?>" class="small"/>&nbsp;&nbsp;<span class="red">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Logo地址</td>
                            <td>
                                <input type="text" name="logourl" value="<?php echo $friendlink['logourl']; ?>" class="small"/>&nbsp;&nbsp;<span class="red">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">关键字</td>
                            <td>
                                <input type="text" name="keyword" value="<?php echo $friendlink['keyword']; ?>" class="small"/>&nbsp;&nbsp;<span class="red">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">排序</td>
                            <td>
                                <input type="text" class="small" name="seq" value="<?php echo $friendlink['seq']; ?>" />&nbsp;&nbsp;<span class="red">*</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">是否审核</td>
                            <td>
                                <?php
                                if($friendlink['isauth'] == 1){
                                 ?>
                                    <input type="checkbox" name="isauth" value="1"  checked="checked"/>
                                 <?php
                                }else{
                                    ?>
                                    <input type="checkbox" name="isauth" value="1"  />
                                <?php
                                }
                                ?>

                            </td>
                        </tr>
                    </table>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/manage/plugins/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    function save(){
        if($("#form_edit").validationEngine('validate')){
            document.forms['form_edit'].submit();
        }
    }
</script>