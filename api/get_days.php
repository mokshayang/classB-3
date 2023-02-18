<?php include_once "base.php";
$row = $Movie->find($_GET['id']);
$date = $row['ondate'];
$today = strtotime(date("Y-m-d"));
$tt = 3 +(strtotime($date)-$today)/(60*60*24);
for($i=0;$i<$tt;$i++){
    $day = date("Y-m-d",strtotime("+$i day"));
    $str = date("m月d日 l",strtotime("+$i day"));
    echo "<option value='$day'>$str</option>";
}