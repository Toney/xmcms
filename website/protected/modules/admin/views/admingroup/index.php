<div class="grid_12 container">
    <div class="container_in">
        <?php
        if ($this->actExist('Add')) {
            ?>
            <div class="viewbar tar ptr10">
                <button class="btn" onclick="showedit(0)">添加</button>
            </div>
        <?php
        }
        ?>
        <table class="list">
            <thead>
            <tr>
                <th class="tal">组名</th>
                <?php
                if ($this->actExist('Edit,Del')) {
                    ?>
                    <th class="last" style="width:200px;">工具</th>
                <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($groups) > 0) {
                foreach ($groups as $g) {
                    ?>
                    <tr>
                        <td class="tal"><?php echo $g['groupname']; ?></td>
                        <?php
                        if ($this->actExist('Edit,Del')) {
                            ?>
                            <td class="last tac">
                                <?php
                                if ($this->actExist('Edit')) {
                                    ?>
                                    <button class="btn" onclick="showedit(<?php echo $g['admingroup_id']; ?>)">
                                        编辑
                                    </button>
                                    <button class="btn"
                                            onclick="showsetpermission(<?php echo $g['admingroup_id']; ?>)">编辑权限
                                    </button>
                                <?php
                                }

                                if ($this->actExist('Del')) {
                                    ?>
                                    <button class="btn" onclick="del(<?php echo $g['admingroup_id']; ?>)">删除
                                    </button>
                                <?php
                                }
                                ?>

                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    function showedit(id) {
        window.location.href = "showedit?id=" + id;
    }
    function del(id) {
        confirm(function () {
            window.location.href = "del?id=" + id;
        }, '确定删除管理员群组？')
    }
    function showsetpermission(id) {
        window.location.href = "showsetpermission?id=" + id;
    }
</script>
