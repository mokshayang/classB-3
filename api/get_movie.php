<?php include_once "base.php";
$st = date("Y-m-d",strtotime("-2 day"));
$day = date("Y-m-d");
$ts = $Movie->all(['sh'=>1]," && ondate between '$st' and '$day' ");
foreach($ts as $t){
    echo "<option value='{$t['id']}'>{$t['name']}</option>";
}
