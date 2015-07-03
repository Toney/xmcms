<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i class="icon-angle-double-right"></i>界面设置</span>
    <span><i class="icon-angle-double-right"></i>FLASH设置</span>
    <span><i class="icon-angle-double-right"></i>FLASH编辑：<?php echo $flash['title']; ?>(<?php echo $flash['name']; ?>
        )</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <div class="toolbar">
            <span class="fr"><input type="button" value="添加" class="ui-button ui-widget ui-state-default " onclick="showedit(null)"></span>
        </div>

        <table class="list">
            <thead class="ui-widget-header">
            <tr>
                <th class="tal">图片</th>
                <th>标题</th>
                <th>描述</th>
                <th class="w25">排序</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($flashimages) > 0) {
                foreach ($flashimages as $f) {
                    ?>
                    <tr>
                        <td><a href="<?php echo Yii::app()->theme->baseUrl ?>/<?php echo $f['imageurl']; ?>"
                               class="review"><img width="200px" height="123" src="<?php echo $f['imageurl']; ?>"/></a>
                        </td>
                        <td class="w200"><?php echo $f['title']; ?></td>
                        <td class="w200"><?php echo $f['imagedesc']; ?></td>
                        <td class="w30"><?php echo $f['seq']; ?></td>
                        <td class="w80">
                            <a><i class="icon-edit" onclick="showedit(<?php echo $f['flashimage_id']; ?>)" ></i></a>
                            <a><i class="icon-trash-empty" onclick="del(<?php echo $f['flashimage_id']; ?>)"></i></a>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<div class="hid">
    <div id="dig_flashimage" class="dialog-form" title="图片编辑">
        <form name="form_flashimage" id="form_flashimage" class="p10" method="post" action="index.php?r=admin/flash/edit">
            <input type="hidden" name="flashimage_id"/>
            <input type="hidden" name="flash_id" value="<?php echo $flash_id; ?>"/>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <table class="form">
                <tr>
                    <td class="col1 bdnone">图片<span class="red">*</span></td>
                    <td class="bdnone">
                        <input type="text" class="control validate[required] w200" name="imageurl" readonly="readonly">
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input type="button" id="imageselect" class="ui-button ui-state-default" value="选择图片"/>&nbsp;&nbsp;<input type="button" class="ui-button ui-state-default" value="预览" onclick="viewImg()">
                    </td>
                </tr>
                <tr>
                    <td class="col1">标题<span class="red">*</span></td>
                    <td><input type="text" class="control validate[required] w200" name="title"/></td>
                </tr>
                <tr>
                    <td class="col1">链接<span class="red">*</span></td>
                    <td><input type="text" class="control validate[required] w200" name="link"/>
                    </td>
                </tr>
                <tr>
                    <td class="col1">描述<span class="red">*</span></td>
                    <td><textarea class="w618 validate[required] control" name="imagedesc"></textarea></td>
                </tr>
                <tr>
                    <td class="col1">排序<span class="red">*</span></td>
                    <td><input type="text" class="w200 control validate[required,custom[integer]] "
                               name="seq"/></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/themes/default/default.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/kindeditor/lang/zh_CN.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    var current = null;
    var flash_id = <?php echo $flash_id; ?>;
    var title = "";
    $(function () {

        $("#form_flashimage").validationEngine({promptPosition:'inline'});

        $("#dig_flashimage").dialog({
            title: title,
            autoOpen: false,
            height: 370,
            width: 600,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                '确定': function () {
                    if ($('#form_flashimage').validationEngine('validate')) {
                        document.forms['form_flashimage'].submit();
                    }
                },
                '取消': function () {
                    $(this).dialog("close");
                }
            },
            close: function () {
                $("input[name=flashimage_id]").val("");
                $("input[name=imageurl]").val("");
                $("input[name=title]").val("");
                $("input[name=link]").val("");
                $("textarea[name=imagedesc]").text("");
                $("input[name=seq]").val("");
            },
            open: function () {
                if (current != null) {
                    //编辑
                    $.get('index.php?r=admin/flash/json', {id: current}, function (result) {

                        if(result.type == true){
                            res = result.data;
                            $("input[name=flashimage_id]").val(current);
                            $("input[name=imageurl]").val(res.imageurl);
                            $("input[name=title]").val(res.title);
                            $("input[name=link]").val(res.link);
                            $("textarea[name=imagedesc]").text(res.imagedesc);
                            $("input[name=seq]").val(res.seq);
                        }else{
                            alert(result.message);
                        }

                    }, 'json');
                }
            }
        });


        KindEditor.ready(function (K) {
            var editor = K.editor({
                allowFileManager: true,
                urlType: 'relative',
                fileManagerJson: '<?php echo Yii::app()->request->baseUrl?>/css/admin/kindeditor/file_manager_json.php',
                uploadJson: '<?php echo Yii::app()->request->baseUrl?>/css/admin/kindeditor/upload_json.php'
            });

            K('#imageselect').click(function (event) {
                editor.loadPlugin('image', function () {
                    editor.plugin.imageDialog({
                        showRemote: true,
                        imageUrl: $("input[name=imageurl]").val(),
                        clickFn: function (url, title, width, height, border, align) {
                            $("input[name=imageurl]").val(url);
                            editor.hideDialog();
                        }
                    });
                });
                event.preventDefault();
            });

        });

    });
    function showedit(fmid) {
        current = fmid;
        if (fmid != null) {
            title = "图片编辑";
            $("#form_flashimage").attr("action","index.php?r=admin/flash/edit");
            $("#dig_flashimage").dialog("open");
        } else {
            title = "图片添加";
            $("#form_flashimage").attr("action","index.php?r=admin/flash/add");
            $("#dig_flashimage").dialog("open");
        }
    }
    function del(fmid) {
        confirm(function () {
            window.location.href = "index.php?r=admin/flash/del&flashimage_id=" + fmid + "&flash_id=" + flash_id;
        }, '确定删除图片？')
    }
    function viewImg() {
        var imageurl = $("input[name=imageurl]").val();
        if (!isNull(imageurl)) {
            $("a#prviewimg").trigger("click");
        } else {
            alert("图片不能为空");
        }
    }
</script>