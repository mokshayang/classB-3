<?php include_once "base.php";
$st = date("Y-m-d",strtotime("-2 day"));
$day = date("Y-m-d");
$rows = $Movie->all(['sh'=>1]," && ondate between '$st' and '$day' ");
foreach($rows as $row){
    echo "<option value='{$row['id']}'>{$row['name']}</option>";
}