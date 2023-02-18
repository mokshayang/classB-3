<?php include_once "base.php";
foreach($_POST['id'] as $k => $id){
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        $Tp->del($id);
    }else{
        $Tp->save([
            'id'=>$id,
            'name'=>$_POST['name'][$k],
            'sh'=>(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0,
            'ani'=>$_POST['ani'][$k],
           
        ]);

    }
}
to("../back.php?do=tp");