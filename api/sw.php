<?php include_once "base.php";

$db = new DB($_POST['table']);
// $db = ${$_POST['table']};

//先取出

$row1 = $db->find($_POST['id1']);
$row2 = $db->find($_POST['id2']);

//交換
$tmp = $row1['rank'];
$row1['rank'] = $row2['rank'];
$row2['rank'] = $tmp;

//寫入
$db->save($row1);
$db->save($row2);
