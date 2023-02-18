<?php include_once "base.php";
if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../upload/".$_FILES['img']['name']);

    $Tp->save([
            'name'=>$_POST['name'],
            'img'=>$_FILES['img']['name'],
            'sh'=>1,
            'rank'=>$Tp->max('id')+1,
            'ani'=>rand(1,3),
            ]);
}
to("../back.php?do=tp");