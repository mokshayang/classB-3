<?php include_once "base.php";
$row = $Movie->find($_GET['id']);
$date = $_GET['date'];
$hr = date("G");
// 因為要計算當天的場次 就是時間 所以承接的時間要判斷是否為今天
if($date == date("Y-m-d") && $hr >=14){
    $st = ($hr/2)-5;
}else{
    $st = 1;
}
for($i=$st;$i<=5;$i++){
    $tt = $Ord->sum('qt',['name'=>$row['name'],'date'=>$date,'session'=>$Ord->ot[$i]]);
    echo "<option value='{$Movie->ot[$i]}'>";
    echo $Movie->ot[$i];
    echo "剩餘座位" . (20-$tt);
    echo "</option>";
}