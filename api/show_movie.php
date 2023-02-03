<?php  include_once "base.php";

$movie = $Movie->find($_POST['id']);

// if($movie['sh']==1){ //正規 if判斷
//     $movie['sh']=0;
// }else{
//     $movie['sh'] = 1;
// }


// $movie['sh']=($movie['sh']==1)?0:1; // 三元判斷式
$movie['sh'] = ($movie['sh']+1)%2;//餘數定理 1 與 0 切換
$Movie->save($movie);
?>