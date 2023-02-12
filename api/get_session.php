<?php include_once "base.php";
$row = $Movie->find($_GET['id']);
$date = $_GET['date'];
$hr = date("G");
if ($date == date("Y-m-d") && $hr >= 14) {
    $start = floor($hr / 2) - 5;
} else {
    $start = 1;
}
for ($i = $start  ; $i <= 5; $i++) {
    /*
    1. 這之前 : 要先找出 所有的訂單紀錄 (電影id 日期date 場次sesseion )
       $Order->all(['movie'=>$movie,'date'=>$date,'session'=>$session]);
    2. 計算出總數 : foreach($orders as $order){$seats+=$order['seats']};
    3. 計算剩餘的座位 : 20-$seats;
    */
    echo "<option value='{$Movie->sss[$i]}'>";
    echo $Movie->sss[$i];
    echo " 剩餘座位 20"; // n = 20-被訂走的總數(座位)
    echo "</option>";
}


