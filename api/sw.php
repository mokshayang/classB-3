<?php include_once "base.php";
//先取出
$row1 = $Trailer->find($_POST['id1']);
$row2 = $Trailer->find($_POST['id2']);

//交換
$tmp = $row1['rank'];
$row1['rank'] = $row2['rank'];
$row2['rank'] = $tmp;

//寫入
$Trailer->save($row1);
$Trailer->save($row2);
