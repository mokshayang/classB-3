<?php include_once "base.php";
$row = $Movie->find($_GET['id']);
$ondate = $row['ondate'];
//設定上映日期還有幾天
//上映日期規定為三天 ， 從創建院線片的日期開始算
//設定今天
$today = strtotime(date("Y-m-d"));//將今天的日期化為秒數，要計算用
//還有幾天設定
// $duration = 3 + (strtotime($ondate-date("Y-m-d"))/(60*60*24));
$duration = 3 + (( strtotime($ondate) -$today)/(60*60*24));
for($i=0; $i<$duration; $i++){
    $date = date("Y-m-d" , strtotime("+$i days"));
    $str = date("m月d日 l" , strtotime("+$i days"));
    echo "<option value='$date'>$str</option>";
}
