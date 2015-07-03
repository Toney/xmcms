<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>界面设置</span><span><i class="icon-angle-double-right"></i>在线交流</span>
</div>

<div class="grid_12 container">
    <div class="container_in">

        <div class="toolbar">
            <span class="fr">
            <input type="button" value="添加" class=" ui-button ui-state-default"
                   onclick="showedit()"/>
            </span>
        </div>

        <table class="list">
            <thead>
            <tr class="ui-widget-header" >
                <th>标题</th>
                <th>QQ</th>
                <th>淘宝旺旺</th>
                <th>MSN</th>
                <th class="w_20">排序</th>
                <th class="w80">工具</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($onlines) > 0) {
                foreach ($onlines as $o) {
                    ?>
                    <tr>
                        <td class="w200"><?php echo $o['name']; ?></td>
                        <td><?php echo $o['qq']; ?></td>
                        <td><?php echo $o['taobaowangwang']; ?></td>
                        <td><?php echo $o['msn']; ?></td>
                        <td class="w_30"><?php echo $o['seq']; ?></td>
                        <td class="w80 ">

                            <a><i class="icon-edit" onclick="showedit(<?php echo $o['online_id']; ?>)" ></i></a>
                            <a><i class="icon-trash-empty" onclick="del(<?php echo $o['online_id']; ?>)"></i></a>

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
    <div id="dig_online" class="dialog-form" title="在线交流">
        <form name="form_online" id="form_online" class="p10" method="post" action="index.php?r=admin/online/edit">
            <input type="hidden" name="online_id"/>
            <table class="form">
                <tr>
                    <td class="col1">标题<span class="red">*</span></td>
                    <td><input type="text" class="control validate[required] w200" name="name"/></td>
                </tr>
                <tr>
                    <td class="col1">QQ<span class="red">*</span></td>
                    <td><input type="text" class="control validate[required] w200" name="qq"/>
                    </td>
                </tr>
                <tr>
                    <td class="col1">淘宝旺旺</td>
                    <td><input type="text" class="control w200" name="taobaowangwang"/></td>
                </tr>
                <tr>
                    <td class="col1">MSN</td>
                    <td><input type="text" class="control w200" name="msn"/></td>
                </tr>
                <tr>
                    <td class="col1">排序<span class="red">*</span></td>
                    <td><input type="text" class="control validate[required,custom[integer]] "
                               name="seq"/></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/css/validationEngine.jquery.css"/>
<script src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script
    src="<?php echo Yii::app()->request->baseUrl ?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>
    var current = null;
    var title = "";
    $(function () {

        $("#form_online").validationEngine({promptPosition:'inline'});

        $("#dig_online").dialog({
            autoOpen: false,
            title: title,
            height: 390,
            width: 600,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                '确定': function () {
                    if ($('#form_online').validationEngine('validate')) {
                        document.forms['form_online'].submit();
                    }
                },
                '取消': function () {
                    $(this).dialog("close");
                }
            },
            close: function () {
                $("input[name=online_id]").val("");
                $("input[name=name]").val("");
                $("input[name=seq]").val("");
                $("input[name=qq]").val("");
                $("input[name=taobaowangwang]").val("");
                $("input[name=msn]").val("");
            },
            open: function () {
                if (current != null) {
                    //编辑
                    $.get('index.php?r=admin/online/json', {id: current}, function (result) {
                        if(result.type==true){
                            var res = result.data;
                            $("input[name=online_id]").val(res.online_id);
                            $("input[name=name]").val(res.name);
                            $("input[name=seq]").val(res.seq);
                            $("input[name=qq]").val(res.qq);
                            $("input[name=taobaowangwang]").val(res.taobaowangwang);
                            $("input[name=msn]").val(res.msn);
                        }else{
                            alert(result.message);
                        }
                    }, 'json');
                }
            }
        });
    });
    function showedit(id) {
        current = id;
        if (id != null) {
            title = "在线交流编辑";
            $("#dig_online").dialog("open");
        } else {
            title = "在线交流添加";
            $("#dig_online").dialog("open");
        }
    }
    function del(id) {
        confirm(function () {
            window.location.href = "index.php?r=admin/online/del&id=" + id;
        }, '删除在线交流？')
    }
</script>