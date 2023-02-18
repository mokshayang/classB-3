<?php include_once "base.php";
$st = date("Y-m-d",strtotime("-2 day"));
$day = date("Y-m-d");
$ms = $Movie->all(['sh'=>1]," ondate between '$st' and '$day' ");

foreach($ms as $m){
    echo "<option value='{$m['id']}'>{$m['name']}</option>";
}