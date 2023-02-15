<h3 class="ct">訂單編號</h3>
<div>
    快速刪除 :
    依日期 <input type="radio" name="type" value="date" checked>
    <input type="text" id="date">
    依電影 <input type="radio" name="type" value="movie">
    <select name="" id="movie">
        <?php
        $rows = $Ord->all(" group by movie ");
        foreach ($rows as $row) {
            echo "<option value='{$row['movie']}'>{$row['movie']}</option>";
        }
        ?>
    </select>
    <button onclick="qDel()">刪除</button>
</div>
<style>
    .head,
    .item {
        display: grid;
        grid-template-columns: repeat(4, 3fr) 2fr 3fr 2fr;
        align-items: center;
        /* justify-items: center; */
        text-align: center;
        grid-gap: 3px;
    }

    .head {
        margin-top: 5px;
        width: 98%;
    }

    .head div {
        background: #999;
    }

    .all {
        height: 350px;
        overflow: auto;
    }

    .item {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-top: 8px;
        height: 84px;
    }
</style>
<div class="head">
    <div>訂單編號</div>
    <div>電影名稱</div>
    <div>日期</div>
    <div>場次時間</div>
    <div>訂購數量</div>
    <div>訂購位置</div>
    <div>操作</div>
</div>
<div class="all">
    <?php
    $ords = $Ord->all(" order by num desc");
    foreach ($ords as $ord) {
    ?>
        <div class="item">
            <div><?= $ord['num'] ?></div>
            <div><?= $ord['movie'] ?></div>
            <div><?= $ord['date'] ?></div>
            <div><?= $ord['session'] ?></div>
            <div><?= $ord['qt'] ?></div>
            <div>
                <?php
                $seats = unserialize($ord['seats']);
                foreach ($seats as $seat) {
                    echo floor(($seat / 5) + 1) . "排" . ($seat % 5 + 1) . "號";
                    echo "<br>";
                }
                ?>
            </div>
            <div>
                <button onclick="del('ord',<?= $ord['id'] ?>)">刪除</button>
            </div>
        </div>
    <?php } ?>
</div>
<script>
    function qDel() {
        let type = $("input[name='type']:checked").val();
        let val;
        switch (type) {
            case 'date':
                val = $('#date').val()
                break;
            case 'movie':
                val = $('#movie').val()
                break;
        }
        let chk = confirm(`是否確定刪除${val}的所有資料`);
        if (chk) {
            $.post("./api/qDel.php", {
                type,
                val
            }, () => {
                location.reload();
            })
        }
    }
</script>