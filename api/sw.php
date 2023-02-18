<?php include_once "base.php";
$db = new DB($_POST['table']);
$t1 = $db->find($_POST['id1']);
$t2 = $db->find($_POST['id2']);
$tmp = $t1['rank'];
$t1['rank'] = $t2['rank'];
$t2['rank'] = $tmp;

$db->save($t1);
$db->save($t2);
