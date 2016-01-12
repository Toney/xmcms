function warn(messa)
{
    $.jGrowl(messa, { header: '警告信息',theme:'warn'});
}
function success(messa){
    $.jGrowl(messa, { header: '成功提示',theme:'success' });
}
function notice(messa)
{
    $.jGrowl(messa, { header: '提示信息',theme:'notice' });
}
function error(messa){
    $.jGrowl(messa, { header: '错误信息',theme:'error',sticky:true });
}
function alert(messa)
{
    $.jGrowl(messa, { header: '警告信息',theme:'error'});
}
function mask(){
    $("body").mask("系统正在加载中……");
}
function unmask(){
    $("body").unmask();
}
/*刷新全站缓存*/
function clearAll(){
    $.get('index.php?r=admin/cache/clearCache',{cache:'all'},function(result){
        if(result.type == true){
            success("缓存清除成功");
        }else{
            alert(result.message);
        }
    },'json');
}
/*
 JavaScript正则验证字符串是否为空
 用途：检查输入字符串是否为空或者全部都是空格
 输入量是一个字符串：str
 返回：如果输入量全是空返回true,否则返回false
 */
function isNull(str){
    if ( str == "" ) return true;
    var regu = "^[ ]+$";
    var re = new RegExp(regu);
    return re.test(str);
}
function confirm(callback,msg)
{
    var msgstr = "确定删除吗?";
    if(typeof(msg) != "undefined"){
        msgstr = msg;
    }
    if($("#dialogconfirm").length==0)
    {
        $("body").append('<div id="dialogconfirm" ><div class="alert_msg" >'+msgstr+'</div></div>');

    }
    $("#dialogconfirm").dialog({
        autoOpen:true,
        title:'确认消息框',
        resizable: false,
        height:140,
        modal: true,
        buttons:{
            '确定':function(ev){
                ev.preventDefault();
                callback();
                $(this).dialog('close');
            },
            '取消':function(ev){
                ev.preventDefault();
                $(this).dialog('close');
            }
        }
    });
}

// kindeditor拓展
var editoritem_all = [ 'source', '|', 'undo', 'redo', '|', 'preview', 'print',
    'template', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|',
    'justifyleft', 'justifycenter', 'justifyright', 'justifyfull',
    'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent',
    'subscript', 'superscript', 'clearhtml', 'quickformat', 'selectall',
    '|', 'fullscreen', '/', 'formatblock', 'fontname', 'fontsize', '|',
    'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
    'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash',
    'media', 'insertfile', 'table', 'hr', 'emoticons', 'map', 'code',
    'pagebreak', 'anchor', 'link', 'unlink' ];
var editoritem_default = [ 'source', '|', 'undo', 'redo', '|', 'justifyleft',
    'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist',
    'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript',
    'clearhtml', 'selectall', '/', 'formatblock', 'fontname', 'fontsize',
    '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
    'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash',
    'media', 'insertfile', 'table', 'emoticons', 'code', 'link', 'unlink' ];
var editoritem_more = [ 'source', '|', 'undo', 'redo', '|', 'preview', 'print',
    'template', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|',
    'justifyleft', 'justifycenter', 'justifyright', 'justifyfull',
    'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent',
    'subscript', 'superscript', 'clearhtml', 'quickformat', 'selectall',
    '/', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor',
    'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough',
    'lineheight', 'removeformat', '|', 'image', 'flash', 'media',
    'insertfile', 'table', 'hr', 'emoticons', 'code', 'pagebreak',
    'anchor', 'link', 'unlink' ];
function initEdit(name,module,resizeType){
    if(resizeType == null){
        resizeType =1;
    }
    var editor = KindEditor.create('textarea[name="'+name+'"]', {
        resizeType : 1,
        allowPreviewEmoticons : true,
        allowImageUpload : true,
        allowFileManager : true,
        resizeType:resizeType,
        urlType : 'relative',
        items:editoritem_more,
        uploadJson:'css/admin/kindeditor/upload_json.php?module='+module,
        fileManagerJson:'css/admin/kindeditor/file_manager_json.php?module='+module,
        afterBlur: function(){this.sync();},
        filterMode: false//是否开启过滤模式
    });
    return editor;
}
function triggerCK(){
    var cked = $("input[name=ckall]").prop("checked");
    if(cked == false){
        $("input[name=ck]").removeProp("checked");
    }else{
        $("input[name=ck]").prop("checked",true);
    }
}
$(function(){
    $("table.form tbody tr").hover(
        function () {
            $(this).addClass("hover");
        },
        function () {
            $(this).removeClass("hover");
        }
    );
    $("table.list tbody tr").hover(
        function () {
            $(this).addClass("hover");
        },
        function () {
            $(this).removeClass("hover");
        }
    );
});