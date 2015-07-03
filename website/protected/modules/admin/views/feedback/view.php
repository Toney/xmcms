<div class="grid_12 bar">
    <span class="item"><i class="icon-home"></i>后台首页</span><span><i
            class="icon-angle-double-right"></i>信息管理</span><span><i class="icon-angle-double-right"></i>查看反馈</span>
    <span><i class="icon-angle-double-right"></i>反馈查看</span>
</div>

<div class="grid_12 container">
    <div class="container_in">
        <table class="form">
            <tr>
                <td class="col1">作者</td>
                <td><?php echo $feedback['name']; ?></td>
            </tr>
            <tr>
                <td class="col1">邮件</td>
                <td><?php echo $feedback['email']; ?></td>
            </tr>
            <tr>
                <td class="col1">类型</td>
                <td><?php echo $feedback->module->category ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $feedback['content'] ?>
                </td>
            </tr>
        </table>
    </div>
</div>