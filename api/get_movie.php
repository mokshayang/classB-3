<?php include_once "base.php";
//取得三日內的電影
$day=date("Y-m-d");
$start=date("Y-m-d",strtotime("-2 day"));
$rows = $Movie->all(['sh'=>1]," && ondate between '$start' and '$day' ");
foreach ($rows as $key => $row) {
    echo "<option value='{$row['id']}'>{$row['name']}</option>";
}