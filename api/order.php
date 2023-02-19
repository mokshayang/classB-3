<?php include_once "base.php";
if (!empty($_POST['seats'])) {
    $max = $Ord->max('id') + 1;
    $_POST['num'] = date("Ymd") . sprintf("%04d", $max);
    sort($_POST['seats']);
    $_POST['qt'] = count($_POST['seats']);
    $_POST['seats'] = serialize($_POST['seats']);
    $Ord->save($_POST);
?>
    <div class="ct">
        <p>感謝您的訂票，訂單號碼 <?= $_POST['num'] ?></p>
        <p>電影名稱 : <?= $_POST['movie'] ?></p>
        <p>日期 : <?= $_POST['date'] ?></p>
        <p>場次時間 : <?= $_POST['session'] ?></p>
        <p>
            座位 : <br>
            <?php
            $seats = unserialize($_POST['seats']);
            foreach ($seats as $seat) {
                echo floor(($seat / 5) + 1) . "排" . ($seat % 5 + 1) . "號";
                echo "<br>";
            }
            ?>
            共 <?= $_POST['qt'] ?>張電影片
            <br>
        </p>
        <div class="ct">
            <button onclick="location.href='index.php'">確定</button>
        </div>






    </div>




<?php } else { ?>
    <h3 class="ct">您尚未選擇座位喔</h3>
    <div class="ct">
        <button onclick="booking()">選擇座位</button>
    </div>

<?php } ?>