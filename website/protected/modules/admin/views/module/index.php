<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>栏目设置</span><span><i class="icon-angle-double-right"></i>栏目管理</span>
</div>

<div class="grid_12 ">
    <div class="container_in bg_white">

        <div class="toolbar">
            <span class="fr">
                <input type="button" value="添加一级栏目" class="ui-button  ui-state-default " onclick="addFirst()" >&nbsp;&nbsp;
                <input type="button" value="保存" class="ui-button  ui-state-default " onclick="saveModule()" >
            </span>
        </div>

        <form name="form_module" id="form_module" >
        <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
        <table class="module" id="module_table">
            <thead class="ui-widget-header">
            <tr>
                <th class="w_40">排序</th>
                <th>栏目名称</th>
                <th class="w_60">导航栏显示</th>
                <th class="w_40">模块</th>
                <th class="w_40">ID</th>
                <th class="w_80">目录名称</th>
                <th class="w_80">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($modules as $m){
                ?>
                <tr  parentid="-1" class="<?php echo $m['childcounts']>0?"haschild":""; ?> tr_<?php echo $m['module_id']; ?>" id="<?php echo $m['module_id']; ?>">
                    <td><input type="text" class="ui w30 validate[required,custom[integer]]" name="seq" value="<?php echo $m['seq']; ?>" /></td>
                    <td><?php echo $m['childcounts']>0?"<img class='mgr_5' src='css/admin/img/colum1nx2.gif'/>":""; ?>
                        <input type="text" class="ui w200" value="<?php echo $m['category']; ?>" name="category" />
                    </td>
                    <td>
                        <select name="ishid" class="ui">
                            <?php
                            if($m['ishid']==0){
                                ?>
                                <option selected="selected" value="0">是</option>
                                <option value="1">否</option>
                                <?php
                            }else{
                                ?>
                                <option value="0">是</option>
                                <option selected="selected" value="1">否</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td><?php echo $this->getModuleName($m['module']); ?></td>
                    <td><?php echo $m['module_id']; ?></td>
                    <td><?php echo $m['module']=='link'?$m['url']:$m['module']; ?></td>
                    <td>
                        <a><i class="icon-doc" title="新建" onclick="addSecond(<?php echo $m['module_id']; ?>)" ></i></a>
                        <a><i class="icon-edit" title="编辑" onclick="showedit(<?php echo $m['module_id']; ?>)" ></i></a>
                        <a><i class="icon-trash-empty" title="删除" onclick="del(<?php echo $m['module_id']; ?>)"></i></a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
            </form>

    </div>

</div>

<div class="hid">

    <table id="temp_table">
        <tr id="" class="tr_first" parentid="-1">
            <td><input type="text" class="ui w30  validate[required,custom[integer]]" name="seq" value="0"></td>
            <td>
                <input type="text" name="category" value="" class="ui w200 ">
            </td>
            <td><select class="ui" name="ishid">
                    <option selected="selected" value="0">是</option>
                    <option value="1">否</option>
                </select></td>
            <td>
                <select name="module" class="ui" onchange="changeNextTd(this)">
                    <option value='guide'>内容</option>
                    <option value='feedback'>反馈</option>
                    <option value='article'>文章</option>
                    <option value='product'>产品</option>
                    <option value='message'>留言</option>
                    <option value='download'>下载</option>
                    <option value='image'>图片</option>
                    <option value='job'>招聘</option>
                    <option value='link'>链接</option>
                </select>
            </td>
            <td class="module_en"></td>
            <td><a onclick="delParentTr(this)" ><ititle="删除" class="icon-trash-empty"></i></a></td>
        </tr>
        <tr id="" class="tr_second" parentid="">
            <td><input type="text" class="ui w30  validate[required,custom[integer]]" name="seq" value="0"></td>
            <td><img src="css/admin/img/bg_column.gif" class="columnx ">
                <input type="text" name="category" value="" class="ui w200 ">
            </td>
            <td><select class="ui" name="ishid">
                    <option selected="selected" value="0">是</option>
                    <option value="1">否</option>
                </select></td>
            <td>
                <select name="module" class="ui" onchange="changeNextTd(this)">
                    <option value='guide'>内容</option>
                    <option value='feedback'>反馈</option>
                    <option value='article'>文章</option>
                    <option value='product'>产品</option>
                    <option value='message'>留言</option>
                    <option value='download'>下载</option>
                    <option value='image'>图片</option>
                    <option value='job'>招聘</option>
                    <option value='link'>链接</option>
                </select>
            </td>
            <td class="module_en"></td>
            <td><a onclick="delParentTr(this)" ><ititle="删除" class="icon-trash-empty"></i></a></td>
        </tr>
        <tr id="" class="tr_third" parentid="">
            <td><input type="text" class="ui w30  validate[required,custom[integer]]" name="seq" value="0" ></td>
            <td><img src="css/admin/img/bg_column1.gif" class="columnx mgl_20 mgr_5">
                <input type="text" name="category" value="" class="ui w200 ">
            </td>
            <td>
                <select class="ui" name="ishid">
                    <option selected="selected" value="0">是</option>
                    <option value="1">否</option>
                </select>
            </td>
            <td><select name="module" class="ui" onchange="changeNextTd(this)">
                    <option value='guide'>内容</option>
                    <option value='feedback'>反馈</option>
                    <option value='article'>文章</option>
                    <option value='product'>产品</option>
                    <option value='message'>留言</option>
                    <option value='download'>下载</option>
                    <option value='image'>图片</option>
                    <option value='job'>招聘</option>
                    <option value='link'>链接</option>
                </select></td>
            <td class="module_en">
            </td>
            <td><a onclick="delParentTr(this)" ><i title="删除" class="icon-trash-empty"></i></a></td>
        </tr>
    </table>

</div>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/css/validationEngine.jquery.css" />
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl?>/css/admin/validationEngine/jquery.validationEngine-zh_CN.js"></script>
<script>

var hasLoadAll = Array();
var haschilditems = null;

$(function(){
    haschilditems = $(".haschild");
    loadChildItems();
});
function loadChildItems(){
    if(haschilditems.length>0){
        for(var i=0;i<haschilditems.length;i++){
            $.get('index.php?r=admin/module/ajax_LoadChilds',{id:$(haschilditems[i]).attr("id")},function(res){
                $(".tr_"+res.data.id).after(res.data.html);
                hasLoadAll.push(res.data.id);
                triggerAfterLoad();
            },'json');
        }
    }
}
function triggerAfterLoad(){
    if(hasLoadAll.length==haschilditems.length){
        $("table.module tbody tr").hover(
            function () {
                $(this).addClass("hover");
            },
            function () {
                $(this).removeClass("hover");
            }
        );
    }
}
function addSecond(moduleid){
    var tr = $("#temp_table").find(".tr_second").clone();
    $(tr).attr("parentid",moduleid);
    $(tr).find(".module_en").html($(tr).find("select[name=module]").val());
    var cld = $("tr[parentid="+moduleid+"]:last");
    if(cld.length==0){
        $("tr[id="+moduleid+"]").after($(tr));
    }else{
        $("tr[parentid="+moduleid+"]:last").after($(tr));
    }
}
function addThird(moduleid){
    var tr = $("#temp_table").find(".tr_third").clone();
    $(tr).attr("parentid",moduleid);
    $(tr).find(".module_en").html($(tr).find("select[name=module]").val());
    var cld = $("tr[parentid="+moduleid+"]:last");
    if(cld.length==0){
        $("tr[id="+moduleid+"]").after($(tr));
    }else{
        $("tr[parentid="+moduleid+"]:last").after($(tr));
    }
}
function addFirst(){
    var tr = $("#temp_table").find(".tr_first").clone();
    $(tr).find(".module_en").html($(tr).find("select[name=module]").val());
    if($("#module_table tbody").find("tr").length==0){
        $("#module_table tbody").html($(tr));
    }else{
        $("#module_table tbody").find("tr:last").after($(tr));
    }
}
function changeNextTd(obj){
    if($(obj).val()=='link'){
        //类型是链接的时候
        $(obj).parent("td").next("td").html("<input type='text' class='ui' name='url'/>");
    }else{
        $(obj).parent("td").next("td").html($(obj).val());
    }

}
function saveModule(){
    if($("#form_module").validationEngine('validate')){
        mask();
        var trs = $("#module_table tbody").find("tr");
        if(trs.length>0){
            //JSON.stringify
            var modules = new Array();
            for(var i=0;i<trs.length;i++){
                modules.push({
                    module_id:$(trs[i]).attr("id"),
                    category:$(trs[i]).find("input[name=category]").val(),
                    parent_id:$(trs[i]).attr("parentid"),
                    seq:$(trs[i]).find("input[name=seq]").val(),
                    ishid:$(trs[i]).find("select[name=ishid]").val(),
                    module:$(trs[i]).find("select[name=module]").val(),
                    url:$(trs[i]).find("input[name=url]").val()
                });
            }
            $.post('index.php?r=admin/module/Ajax_ModuleEdit',{modulestrs:JSON.stringify(modules),YII_CSRF_TOKEN:$("input[name=YII_CSRF_TOKEN]").val()},function(res){
                if(res.type==true){
                    window.location.reload();
                }else{
                    alert(res.message);
                }
                unmask();
            },'json');
        }else{
            alert("栏目数量不能为空");
        }
    }
}
function del(moduleid){
    //删除模块
    confirm(function(){
        mask();
        //删除栏目
        $.get('index.php?r=admin/module/del',{moduleid:moduleid},function(result){
            if(result.type == true){
                window.location.reload();
            }else{
                alert(result.message);
            }
            unmask();
        },'json');
    },'确定删除栏目？删除栏目会将栏目对应的内容，全部删掉，确定删除？');
}
function showedit(moduleid){
    //显示编辑模块页面
    window.location.href="index.php?r=admin/module/showedit&moduleid="+moduleid;
}
function delParentTr(obj){
    $(obj).closest("tr").remove();
}
</script>

