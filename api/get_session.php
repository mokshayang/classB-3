<?php include_once "base.php";
$row = $Movie->find($_GET['id']);
$date = $_GET['date'];
$hr = date("G");

if($date == date("Y-m-d") && $hr>=14){
    $st = ($hr/2)-5;
}else{
    $st = 1;
}
for($i = $st;$i<=5;$i++){
    echo "<option value='{$Movie->sss[$i]}'>";
    $tt = $Ord->sum('qt',['movie'=>$row['name'],'date'=>$date,'session'=>$Ord->sss[$i]]);
    echo $Movie->sss[$i];
    echo "剩餘座位 ".(20-$tt);
    echo "</option>";
}


