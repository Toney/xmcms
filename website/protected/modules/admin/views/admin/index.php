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
                <th class="tal">姓名</th>
                <th>最后登入时间</th>
                <th>最后登入IP</th>
                <?php
                if ($this->actExist('Edit', 'Del')) {
                    ?>
                    <th class="last" style="width: 150px;">工具</th>
                <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($admins) > 0) {
                foreach ($admins as $a) {
                    ?>
                    <tr>
                        <td><?php echo $a['username']; ?></td>
                        <td class="tac"><?php echo $a['last_logintime']; ?></td>
                        <td class="tac"><?php echo $a['last_loginip']; ?></td>
                        <?php
                        if ($this->actExist('Edit', 'Del')) {
                            ?>
                            <td class="tac">
                                <?php
                                if ($this->actExist('Edit')) {
                                    ?>
                                    <button class="btn" onclick="showedit(<?php echo $a['user_id']; ?>)">
                                        编辑
                                    </button>
                                <?php
                                }

                                if ($this->actExist('Del')) {
                                    ?>
                                    <button class="btn" onclick="del(<?php echo $a['user_id']; ?>)">删除
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
        <?php echo $pagebar->buildBar(); ?>
    </div>
</div>

<script>
    var current = <?php echo $pagebar->current;?>;
    function showedit(id) {
        window.location.href = "showedit?id=" + id + "&current=" + current;
    }
    function del(id) {
        confirm(function () {
            window.location.href = "del?id=" + id + "&current=" + current;
        }, '是否删除账户？')
    }
</script>