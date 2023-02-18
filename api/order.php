<?php include_once "base.php";
// dd($_POST);
if (!empty($_POST['seats'])) {
    $max = $Ord->max('id') + 1;
    $_POST['num'] = date("Ymd") . sprintf("%04d", $max);
    $_POST['qt'] = count($_POST['seats']);
    $_POST['seats'] = serialize($_POST['seats']);
    $Ord->save($_POST);
?>
    <div class="ct">
        <h2 class="ct">感謝您的訂購，您的訂單號碼是 : <?= $_POST['num'] ?></h2>
        <p>電影名稱 : <?= $_POST['movie'] ?></p>
        <p>日期 : <?= $_POST['date'] ?></p>
        <p>場次時間 : <?= $_POST['session'] ?></p>
        <div>座位 : <br>
            <?php
            $seats = unserialize($_POST['seats']);
            foreach ($seats as $seat) {
                echo "<div>";
                echo floor(($seat / 5) + 1) . "排" . ($seat % 5 + 1) . "號";
                echo "<br>";
                echo "</div>";
            }
            ?>
        </div>
        <div>共 <?= count($seats) ?>張電影票</div>
        <button onclick="location.href='index.php'">確定</button>
    </div>
<?php } else { ?>
    <h3 class="ct">請選擇您的座位</h3>
    <div class="ct">
        <button onclick="booking()">選擇座位</button>
    </div>

<?php } ?>