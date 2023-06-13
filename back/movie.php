<button onclick="location.href='?do=movie_add'">新增電影</button>
<hr>
<style>
    .hall {
        height: 350px;
        overflow: auto;
    }

    .item {
        border-radius: 5px;
        border: 1px solid #333;
        margin-top: 5px;
        display: grid;
        grid-template-columns: 3fr 3fr 14fr;
        min-height: 80px;
        justify-items: center;
    }

    .top {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }
</style>

<div class="hall">
    <?php
    $rows = $Movie->all(" order by rank");
    foreach ($rows as $k => $row) {
        $prev = ($k == 0) ? $row['id'] : $rows[$k - 1]['id'];
        $next = ($k + 1 == count($rows)) ? $row['id'] : $rows[$k + 1]['id'];
    ?>
        <div class="item">
            <div>
                <img src="upload/<?= $row['poster'] ?>" style="width:72px">
            </div>
            <div>
                分級 <img src="icon/03c0<?= $row['level'] ?>.png" style="vertical-align:middle;">
            </div>
            <div class="rig">
                <div class="top">
                    <div>片名 :<?= $row['name'] ?></div>
                    <div>片長 :<?= $row['length'] ?></div>
                    <div>上映日期 :<?= $row['date'] ?></div>
                </div>
                <div class="mid">
                    <button onclick="show(<?= $row['id'] ?>)"><?= ($row['sh']) ? '顯示' : '隱藏'; ?></button>
                    <button type="button" onclick="sw('<?= $do ?>',<?= $row['id'] ?>,<?= $prev ?>)">往上</button>
                    <button type="button" onclick="sw('<?= $do ?>',<?= $row['id'] ?>,<?= $next ?>)">往下</button>
                    <button onclick="location.href='?do=movie_edit&id=<?= $row['id'] ?>'">編輯電影</button>
                    <button onclick="del('<?= $do ?>',<?= $row['id'] ?>)">刪除電影</button>
                </div>
                <div>
                    <?=$row['intro']?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>