<style>
    .list{background-color: #FFFFFF;}
    label{font-weight: bold;}
    .fastdo a{margin-right: 20px;}
</style>
<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span>
</div>
<div class="grid_9  ">
    <table class="list mgb">
        <thead>
        <tr class="ui-widget-header">
            <td><label>快捷方式</label></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="fastdo">
                <a href="index.php?r=admin/article/add&id=0"><i class="icon-doc-text"></i>发布文章</a>
                <a href="index.php?r=admin/content/index"><i class="icon-doc-text"></i>内容管理</a>
                <a href="index.php?r=admin/flash/index"><i class="icon-doc-text"></i>FLASH设置</a>
                <a href="index.php?r=admin/module/index"><i class="icon-doc-text"></i>栏目管理</a>
                <a href="index.php?r=admin/template/index"><i class="icon-doc-text"></i>模板设置</a>
                <a href="javascript:clearAll();"><i class="icon-doc-text"></i>缓存刷新</a>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="list mgb">
        <thead>
        <tr  class="ui-widget-header">
            <td colspan="2"><label>未读消息</label></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>反馈信息：<?php echo $new_feedback; ?></td><td>在线留言：<?php echo $new_message; ?></td>
        </tr>
        <tr>
            <td>友情链接：<?php echo $new_friendlink; ?></td><td>会员注册：<a href="index.php?r=admin/user/index"><?php echo $new_user; ?></a></td>
        </tr>
        </tbody>
    </table>

    <table class="list mgb">
        <thead>
        <tr  class="ui-widget-header">
            <td><label>使用说明</label></td>
        </tr>
        </thead>
        <tbody>
        <tr><td>第一步：在系统设置中进行设置基本信息、语言设置、安全与效率等</td></tr>
        <tr><td>第二步：在界面设置中选择网站模板并设置相关参数</td></tr>
        <tr><td>第三步：在栏目配置中设置网站导航栏目及相关参数</td></tr>
        <tr><td>第四步：在内容管理中添加网站内容、底部信息等</td></tr>
        </tbody>
    </table>

    <table class="list mgb">
        <thead>
        <tr  class="ui-widget-header">
            <td><label>版权信息</label></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="col1 w90">XMCMS版本：V3.0</td>
        </tr>
        <tr>
            <td colspan="2">版权声明：1.本软件为商业软件，未经书面授权，不得向任何第三方提供本软件系统。2.本软件受中华人名共和国《著作权法》、《计算机软件保护条例》等相关法律法规保护，X-MAI.COM保留一切权利。</td>
        </tr>
        </tbody>
    </table>

</div>
<div class="grid_3  ">
    <table class="list mgb">
        <thead>
        <tr  class="ui-widget-header">
            <td colspan="2"><label>系统状态</label></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="col1 " style="width: 50%;">文章：<?php echo $count_article;?></td>
            <td class="col1 " style="width: 50%;">产品：<?php echo $count_product; ?></td>
        </tr>
        <tr>
            <td class="col1 " style="width: 50%;">下载：<?php echo  $count_download;?></td>
            <td class="col1 " style="width: 50%;">图片：<?php echo $count_image; ?></td>
        </tr>
        <tr>
            <td class="col1 " style="width: 50%;">招聘：<?php echo $count_job; ?></td>
            <td class="col1 " style="width: 50%;">单页：<?php echo $count_guide; ?></td>
        </tr>
        <tr>
            <td class="col1 " style="width: 50%;">片段：<?php echo $count_fragment; ?></td>
            <td class="col1 " style="width: 50%;">反馈：<?php echo $count_feedback; ?></td>
        </tr>
        <tr>
            <td class="col1 " style="width: 50%;">友情链接：<?php echo $count_friendlink; ?></td>
            <td class="col1 " style="width: 50%;">FLASH：<?php echo $count_flash; ?></td>
        </tr>
        </tbody>
    </table>
    <table class="list  mgb">
        <thead>
        <tr  class="ui-widget-header">
            <td colspan="2"><label>运行环境</label></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="col1 w90">操作系统：</td>
            <td><?php echo php_uname('s');?></td>
        </tr>
        <tr>
            <td class="col1 w90">PHP版本：</td>
            <td><?php echo phpversion(); ?></td>
        </tr>
        <tr>
            <td class="col1 w90">MYSQL版本：</td>
            <td><?php echo $this->connection->serverVersion; ?>&nbsp;&nbsp;
                字符：<?php echo strtoupper($this->connection->charset); ?></td>
        </tr>
        <tr>
            <td class="col1 w90">APACHE版本：</td>
            <td><?php echo apache_get_version(); ?></td>
        </tr>
        </tbody>
    </table>

    <table class="list  mgb">
        <thead>
        <tr  class="ui-widget-header">
            <td colspan="2"><label>服务与支持</label></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>技术支持</td>
            <td>使用手册</td>
        </tr>
        <tr>
            <td>官方网站</td>
            <td>定制开发</td>
        </tr>
        <tr>
            <td colspan="2">邮箱：service@x-mai.com </td>
        </tr>
        </tbody>
    </table>

</div>
