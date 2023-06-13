<h3 class="ct">訂單清單</h3>
<div>快速刪除 :
    依日期 <input type="radio" name="tt" value="date" checked >
    <input type="text" id="date">
    依電影 <input type="radio" name="tt" value="name" >
    <select id="name">
        <?php
        $ods = $Ord->all(" group by no ");
        foreach ($ods as  $od) {
            echo "<option value='{$od['name']}'>";
            echo $od['name'];
            echo "</option>";
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
        text-align: center;
    }

    .head {
        margin-top: 5px;
        width: 98%;
        grid-gap: 5px;
    }

    .head>div {
        background: #ccc;
    }

    .hall {
        height: 350px;
        overflow: auto;
    }

    .item {
        height: 90px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-top: 5px;
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

<div class="hall">
    <?php
    $ods = $Ord->all(" order by no desc");
    foreach ($ods as $od) {
    ?>
        <div class="item">
            <div><?= $od['no'] ?></div>
            <div><?= $od['name'] ?></div>
            <div><?= $od['date'] ?></div>
            <div><?= $od['session'] ?></div>
            <div><?= $od['qt'] ?></div>
            <div>
                <?php
                $ss = unserialize($od['seats']);
                foreach ($ss as $s) {
                    echo floor(($s / 5) + 1) . "排" . ($s % 5 + 1) . "號";
                    echo "<br>";
                }
                ?>
            </div>
            <div>
                <button onclick="del('ord',<?= $od['id'] ?>)">刪除</button>
            </div>
        </div>
    <?php } ?>
</div>
<script>
    function qDel() {
        let type = $("input[type='radio']:checked").val();
        let val;
        switch(type){
            case 'date':
                val = $('#date').val()
                break;
            case 'name':
                val = $('#name').val()
                break;
        }
        let chk = confirm(`確定要刪除${val}的所有資料嗎`);
        if(chk){
            $.post("api/qDel.php",{type,val},()=>{
                location.reload();
            })
        }
    }
</script>