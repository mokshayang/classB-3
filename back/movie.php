<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<style>
    .all,
    .right,
    .rightTop,
    .rightButton {
        display: grid;
    }

    .all {
        grid-template-columns: 3fr 3fr 14fr;
        justify-self: center;
        align-items: center;
        margin: 3px auto;
        border-radius: 5px;
        border: 1px solid #333;
    }

    .right {
        grid-template-rows: 1fr 2fr 3fr;
        grid-gap:2px;
    }

    .rightTop {
        grid-template-columns: repeat(3, 1fr);
    }

    .rightButton {
        grid-template-columns: repeat(5, 1fr);
        align-self: center;
    }

    .item {
        height: 390px;
        overflow: auto;
    }
    .pp img{
        width: 100px;
        border-radius: 5px;
        box-shadow: 0 0 5px #333;
    }
</style>
<div class="item">
    <?php
    $rows = $Movie->all(" order by rank ");
    foreach ($rows as $k => $row) {
        $prev = ($k == 0) ? $row['id'] : $rows[$k - 1]['id'];
        $next = ($k == count($rows) - 1) ? $row['id'] : $rows[$k + 1]['id'];
    ?>
        <div class="all">
            <div style="text-align:center" class="pp">
                <img src="./upload/<?= $row['poster'] ?>" style="width:100px;">
            </div>
            <div>
                分級 : <img src="./icon/03C0<?= $row['level'] ?>.png" style="vertical-align:middle;">
            </div>
            <div class="right">
                <div class="rightTop">
                    <div>片名 : <?= $row['name'] ?></div>
                    <div>片長 : <?= $row['length'] ?> 分鐘 </div>
                    <div>上映時間 : <?= $row['ondate'] ?></div>
                </div>
                <div class="rightButton">
                    <div><button onclick="showMovie(<?= $row['id'] ?>)"><?= ($row['sh'] == 1) ? '顯示' : '隱藏'; ?></button></div>
                    <div><button onclick="sw('<?= $do ?>',<?= $row['id'] ?>,<?= $prev ?>)">往上</button></div>
                    <div><button onclick="sw('<?= $do ?>',<?= $row['id'] ?>,<?= $next ?>)">往下</button></div>
                    <div><button onclick="location.href='?do=edit_movie&id=<?= $row['id'] ?>'">編輯電影</button></div>
                    <div><button onclick="del('<?= $do ?>',<?= $row['id'] ?>)">刪除電影</button></div>
                </div>
                <div>
                    <?= $row['intro'] ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>