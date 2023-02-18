<?php include_once "base.php";
$ondate = $Movie->find($_GET['id'])['ondate'];
$day = strtotime(date("Y-m-d"));

$tt = 3+((strtotime($ondate)-$day))/(60*60*24);
for($i=0;$i<$tt;$i++){
    $date = date("Y-m-d",strtotime("+ $i day"));
    $str = date("m月d日 l",strtotime("+ $i day"));
    echo "<option value=$date>$str</option>";
}