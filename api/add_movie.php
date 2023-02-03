<?php include_once "base.php";
dd($_POST);
if(!empty($_FILES['trailer']['tmp_name'])){//預告片
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../upload/".$_FILES['trailer']['name']);
   $_POST['trailer'] = $_FILES['trailer']['name'];
     
}
if(!empty($_FILES['poster']['tmp_name'])){//海報
    move_uploaded_file($_FILES['poster']['tmp_name'],"../upload/".$_FILES['poster']['name']);
    $_POST['poster'] = $_FILES['poster']['name'];
     
}
/*
$_POST['name'];
$_POST['length'];
$_POST['level'];
$_POST['publish'];
$_POST['director'];
$_POST['intor'];
$_POST['year'];
$_POST['month'];
$_POST['day'];
*/

$_POST['ondate']=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];//先放置 再註銷
unset($_POST['year'],$_POST['month'],$_POST['day']);

$_POST['sh']=1;
$_POST['rank'] = $Movie->max('rank')+1;

$Movie->save($_POST);
to("../back.php?do=movie");